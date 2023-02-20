# hyde-global

Experimental global Hyde binary project

## Installation

### Curl (Global)

```bash
curl https://github.com/caendesilva/hyde-global/releases/latest/download/hyde -Lo hyde
curl https://github.com/caendesilva/hyde-global/releases/latest/download/checksum.txt -Lo checksum.txt
echo "Verifying SHA256 checksum..."
sha256sum -c checksum.txt || echo "Checksum failed!" && exit 1
rm checksum.txt
chmod +x hyde
sudo mv hyde /usr/local/bin/hyde
echo "Hyde installed successfully!"
```
