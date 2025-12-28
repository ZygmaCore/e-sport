#!/bin/bash
apt update -y
apt install -y docker.io curl

systemctl enable docker
systemctl start docker

curl -fsSL https://ngrok-agent.s3.amazonaws.com/ngrok.asc \
  | tee /etc/apt/trusted.gpg.d/ngrok.asc >/dev/null

echo "deb https://ngrok-agent.s3.amazonaws.com buster main" \
  | tee /etc/apt/sources.list.d/ngrok.list

apt update -y
apt install -y ngrok

echo "VM READY" > /home/ubuntu/READY.txt
