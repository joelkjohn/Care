import json
from re import X 
from nltk_util import tokenize, stem, bag_of_words
import numpy as np

import torch
import torch.nn as nn
from torch.utils.data import Dataset, DataLoader

from model import NeuralNet

with open('C:\\xampp\\htdocs\\fyp\\intents.json', 'r') as f:
    intents = json.load(f)

all_words = []
tags = []
xy = []
for intent in intents['intents']:
    tag = intent['tag']
    tags.append(tag)
    for pattern in intent['patterns']:
        w = tokenize(pattern)
        all_words.extend(w)
        xy.append((w, tag))
 
ignore_words = ['?', '!','.', ',']
all_words = [stem(w) for w in all_words if w not in ignore_words]
all_words = sorted(set(all_words))
tags = sorted(set(tags))


X_train =[]
y_train =[]
for (pattern_sentence, tag) in xy:
    bag = bag_of_words(pattern_sentence, all_words)
    X_train.append(bag)

    label = tags.index(tag)
    y_train.append(label) #crossentropyloss
    
X_train = np.array(X_train)
y_train = np.array(y_train)




#Hyperparameters

batch_size = 8    

hidden_size=8
output_size=len(tags)
input_size=len(X_train[0])
learning_rate= 0.001
num_epochs = 1000
print(tags, len(all_words))
print(output_size)


class ChatDataset(Dataset):
    def _init_(self):
        self.n_samples = len(X_train)
        self.x_data = X_train
        self.y_data = y_train

    def _getitem_(self, index):
        return self.x_data[index], self.y_data[index]

    def _len_(self):
        return self.n_samples



dataset = ChatDataset()
print(dataset)
print("v")
train_loader = DataLoader(dataset= dataset, batch_size=batch_size, shuffle=True, num_workers=0)

model = NeuralNet(input_size, hidden_size, output_size)

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
model = NeuralNet(input_size, hidden_size, output_size).to(device)


criterion = nn.CrossEntropyLoss()
optimizer = torch.optim.Adam(model.parameters(), lr=learning_rate)


for epoch in range(num_epochs):
    for(words, labels) in train_loader:
        words = words.to(device)
        labels = labels.to(dtype=torch.long).to(device)

        outputs = model(words)
        loss = criterion(outputs, labels)

        optimizer.zero_grad()
        loss.backward()
        optimizer.step()

    if (epoch +1) % 100 == 0:
         print(f'epoch  {epoch+1}/{num_epochs}, loss= {loss.item():.4f}')


print(f'final loss, loss= {loss.item():.4f}')
