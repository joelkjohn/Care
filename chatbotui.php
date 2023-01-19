<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />

    <title>Todo App</title>

    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://pyscript.net/latest/pyscript.css" />

    <script defer src="https://pyscript.net/latest/pyscript.js"></script>
    <py-register-widget src="./pylist.py" name="py-list" klass="PyList"></py-register-widget>


    <py-script>
      def add_task(*ags, **kws):
        # create a new dictionary representing the new task
        task = { "content": new_task_content.value,  "done": False, "created_at": dt.now() }

        # add a new task to the list and tell it to use the `content` key to show in the UI
        # and to use the key `done` to sync the task status with a checkbox element in the UI
        myList.add(task)

        # clear the inputbox element used to create the new task
        new_task_content.clear()

    </py-script>
  </head>

  <body>

    <py-env>
    - numpy
    - random
    - nltk
    - torch
    - json
    </py-env>
      <py-title>Chat Bot</py-title>
      <py-script>
        
import numpy as np
import random
import json
import nltk
import torch
import torch.nn as nn
from torch.utils.data import Dataset, DataLoader

from nltk.stem.porter import PorterStemmer
stemmer = PorterStemmer()
import nltk
nltk.download('punkt')

def tokenize(sentence):
    return nltk.word_tokenize(sentence)

def stem(word):
    return stemmer.stem(word.lower())
def bag_of_words(tokenized_sentence, words):
    # stem each word
    sentence_words = [stem(word) for word in tokenized_sentence]
    # initialize bag with 0 for each word
    bag = np.zeros(len(words), dtype=np.float32)
    for idx, w in enumerate(words):
        if w in sentence_words: 
            bag[idx] = 1

    return bag
with open('C:\\xampp\\htdocs\\fyp\\intents.json', 'r') as f:
    intents = json.load(f)
all_words=[]
tags=[]
xy=[]
for intent in intents["intents"]:
  tag=intent['tag']
  tags.append(tag)

  for pattern in intent['patterns']:
    w=tokenize(pattern)
    all_words.extend(w)
    xy.append((w,tag))
ignore_words=['?','.','!']
all_words=[stem(w) for w in all_words if w not in ignore_words]
all_words=sorted(set(all_words))
tags=sorted(set(tags))

print(len(all_words), 'unique stmmed words')
X_train=[]
y_train=[]

for (pattern_sentence,tag) in  xy:
  bag=bag_of_words(pattern_sentence,all_words)
  X_train.append(bag)
  label=tags.index(tag)
  y_train.append(label)

X_train=np.array(X_train)
y_train=np.array(y_train)
class NeuralNet(nn.Module):
    def __init__(self, input_size, hidden_size, num_classes):
        super(NeuralNet, self).__init__()
        self.l1 = nn.Linear(input_size, hidden_size) 
        self.l2 = nn.Linear(hidden_size, hidden_size) 
        self.l3 = nn.Linear(hidden_size, num_classes)
        self.relu = nn.ReLU()
    
    def forward(self, x):
        out = self.l1(x)
        out = self.relu(out)
        out = self.l2(out)
        out = self.relu(out)
        out = self.l3(out)
        # no activation and no softmax at the end
        return out
class ChatDataset(Dataset):

    def __init__(self):
        self.n_samples = len(X_train)
        self.x_data = X_train
        self.y_data = y_train

    # support indexing such that dataset[i] can be used to get i-th sample
    def __getitem__(self, index):
        return self.x_data[index], self.y_data[index]

    # we can call len(dataset) to return the size
    def __len__(self):
        return self.n_samples
num_epochs=1000
batch_size=8
learning_rate=0.001
input_size=len(X_train[0])
hidden_size=8
output_size=len(tags)
print(input_size, output_size)
dataset=ChatDataset()
train_loader=DataLoader(dataset=dataset,batch_size=batch_size,shuffle=True,num_workers=0)
device=torch.device('cuda' if torch.cuda.is_available() else 'cpu')

model=NeuralNet(input_size,hidden_size,output_size).to(device)

criterion=nn.CrossEntropyLoss()
optimizer= torch.optim.Adam(model.parameters(),lr=learning_rate)
# Train the model
for epoch in range(num_epochs):
    for (words, labels) in train_loader:
        words = words.to(device)
        labels = labels.to(dtype=torch.long).to(device)
        # Forward pass
        outputs = model(words)
        # if y would be one-hot, we must apply
        # labels = torch.max(labels, 1)[1]
        loss = criterion(outputs, labels)
        # Backward and optimize
        optimizer.zero_grad()
        loss.backward()
        optimizer.step()
    if (epoch+1) % 100 == 0:
        print (f'Epoch [{epoch+1}/{num_epochs}], Loss: {loss.item():.4f}')
print(f'final loss: {loss.item():.4f}')
data = {
"model_state": model.state_dict(),
"input_size": input_size,
"hidden_size": hidden_size,
"output_size": output_size,
"all_words": all_words,
"tags": tags
}
File="data.pth"
torch.save(data,File)

print("saved")
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

with open('C:\\xampp\\htdocs\\fyp\\intents.json', 'r') as json_data:
    intents = json.load(json_data)

FILE = "data.pth"
data = torch.load(FILE)

input_size = data["input_size"]
hidden_size = data["hidden_size"]
output_size = data["output_size"]
all_words = data['all_words']
tags = data['tags']
model_state = data["model_state"]

model = NeuralNet(input_size, hidden_size, output_size).to(device)
model.load_state_dict(model_state)
model.eval()

def chatFunction(sentence):
    sentence = tokenize(sentence)
    X = bag_of_words(sentence, all_words)
    X = X.reshape(1, X.shape[0])
    X = torch.from_numpy(X).to(device)

    output = model(X)
    _, predicted = torch.max(output, dim=1)

    tag = tags[predicted.item()]

    probs = torch.softmax(output, dim=1)
    prob = probs[0][predicted.item()]
    if prob.item() > 0.75:
        for intent in intents['intents']:
            if tag == intent["tag"]:
                print(f"{bot_name}: {random.choice(intent['responses'])}")
    else:
        print(f"{bot_name}: I do not understand...")


bot_name = "Slut"
print("Let's chat! (type 'quit' to exit)")

while True:

    sentence = input("You: ")
    if sentence == "quit":
        break
    else:
        chatFunction(sentence)

      </py-script>
  </body>
</html>