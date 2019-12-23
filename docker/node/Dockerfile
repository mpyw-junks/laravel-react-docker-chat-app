FROM node:alpine

WORKDIR /node

COPY docker/node/*.json /node/
RUN npm install

EXPOSE 6001
CMD ["npm", "start"]
