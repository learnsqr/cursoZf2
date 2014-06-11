# Bower - http://bower.io/

## Node installation on Centos

    wget http://nodejs.org/dist/node-latest.tar.gz
	tar zxvf node-latest.tar.gz
	cd node-v0.1*
	./configure
	make
    sudo make install

### Checkpoint Charlie

    node --version

## Bower Installation

    npm cache clean
    npm install -g bower

### Checkpoint Charlie

    bower help

   ![Alt text](/assets/developer/bower.png "Bower help")
   
---  

## Bower Update

    sudo npm cache clean
	npm update -g bower
	
### Checkpoint Charlie

    bower -v


---  
   
## Bower Usage 

### File .bowerrc

    {
        "directory": "public/assets/vendor"
	}
	
### File .bower.json

	{
        "name": "cursozf2",
        "version": "0.0.1",
        "ignore": [
            "**/.*"
        ],
        "dependencies": {
            "bootstrap": ">=3.0.0"
        }
    }
    
 	
### Usage

Bower will install all packages and its dependencies on the directory specified in the .bowerrc file.

    bower install
    
    