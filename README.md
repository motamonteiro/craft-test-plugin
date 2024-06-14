# Test Plugin site

Site to test to help on development of the Entry Explorer plugin

## DDEV Installation

```sh
# Install DDEV
brew install ddev/ddev/ddev

# Initialize mkcert
mkcert -install

```

## Launch the Test Plugin Site

```sh
# Start containers
ddev start

# Launch the site
ddev launch

# Launch the admin site
ddev launch admin

# Launch the phpmyadmin
ddev phpmyadmin
```
