FROM python:3.8.0-alpine3.10

WORKDIR /usr/src/app
RUN mkdir -p /usr/src/app
COPY ./source/requirements.txt .
#COPY ./source .
RUN pip install --no-cache-dir -r requirements.txt

EXPOSE 9000


CMD ["gunicorn", "app:app", "--bind", "0.0.0.0:9000", "--workers", "1"]
