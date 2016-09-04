VERSION = $(shell grep "<version>" module/*.xml|cut  -d ">" -f 2|cut -d "<" -f 1)

zip:
	@echo "Creating zip file for version $(VERSION)"
	@(cd module && zip -r ../mod-show-translated-$(VERSION).zip *)

all: zip
