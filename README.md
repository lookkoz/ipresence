# iPresence Tech Test 


##### Installation instrucitons for OSX / Linux with common docker and composer setup
```
# Add a ipresence entry to host file
echo -e '127.0.0.1\tipresence\n' | sudo tee -a /etc/hosts

# run
composer install

# run
make run-app
```

##### Running tests - requires installed phpunit ans xdebug
```
# unit tests
make run-unit-tests

# functional tests
make run-functional-tests
```