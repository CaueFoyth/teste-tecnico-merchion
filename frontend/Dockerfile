# Estágio Base: instala dependências comuns
FROM node:20-alpine AS base
WORKDIR /app
COPY package*.json ./

# Estágio de Desenvolvimento (igual ao seu original)
FROM base AS dev
RUN npm install
COPY . .
EXPOSE 3030
CMD ["npm", "run", "dev"]


# Estágio de Build: Gera os arquivos finais da aplicação
FROM base AS build
RUN npm install
COPY . .
RUN npm run build


# Estágio de Produção (CORRIGIDO PARA NUXT.JS)
FROM base AS prod
WORKDIR /app

COPY package*.json ./
RUN npm install --production

COPY --from=build /app/.output ./.output

EXPOSE 3030

CMD ["npm", "start"]