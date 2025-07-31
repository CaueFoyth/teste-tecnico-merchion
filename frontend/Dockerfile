# frontend/Dockerfile
FROM node:18-alpine

WORKDIR /app

# Copia package.json e lock file
COPY package*.json ./

# Instala as dependências
RUN npm install

# Copia o resto do código da aplicação
COPY . .

# Expõe a porta do Nuxt
EXPOSE 3000

# Comando para iniciar o servidor de desenvolvimento
CMD ["npm", "run", "dev"]