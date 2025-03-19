# Current Version
-> Version 1.2 – Graduate Profiles
   Version 1.1 – UI Update
   Version 1.0 – Base Version / Lauch

## About Version 1.2
- Managing of Graduate Profiles
- Custom LogIn for every Graduate
- You can only see the pages you have made yourself
- No more need for graduates Page as this is now bundeld into the users




# Welcome

Hey welcome to this project! This is the official™ Klasse Digitale Grafik archive for all thesis projects – for now at least. 
**[You can visit the website here](https://thesis.digitale-grafik.com/)**

## About
thesis.digitale-grafik is a resource for Klasse Digitale Grafik. I wanted to make an archive for all theses written during the graduation process to combat the loss of knowledge in our class – hopefully. I hope that this project can be run by students in the long term with minimal supervision from our Professors and the University.

In a way this whole website is "just" a glorified spreadsheet. There exists a somewhat spotty/lossy version of this site as a google spreadsheet, but I really hope this website can be a better framework to save, retrieve and work with all the topics that are and have been relevant in Klasse Digitale Grafik.

This Archive has the following main functions
- Make thesis projects more accessible by providing searchable text and keywords 
- Archive/Download the PDFs of the written thesis part
- Archive the thesis website, so it's not gone once alumni decide to not host it for ever. 

## thesis.digitale-grafik as a framework
On a technical level my idea behind this website is that it will work somewhat long(er) term without the need to be updated on a regular basis or the fear of stuff breaking. thesis.digitale-grafik runs mostly without any libraries or dependencies – the only one beeing (in a way sadly) Kirby CMS 4, for ease of use. 

For all the core features I tried to implement a somewhat modular approach. This means one feature has no effect or dependencies with any other feature. So if for exampe DevMode breaks, SearchMode still works without any problems and the other way round. For the future it would be great, if this would also be true for all further development. 

A feature should be
- selfcontained
- run without any other scripts/libraries
- documented


### Features
Here are the currently present features of thesis.digitale-grafik.

#### SearchMode (CORE)
SearchMode is the core feature of the website. It handles everything related to search on the website. So the searchbar, searchresults and tags. For more documentation check searchmode.php, searchmode.js or visit the web sourcecode of thesis.digitale-grafik. 

#### DevMode
DevMode is all the fun you can have on the website. Including ingestible css and themes.
For more documentation check devmode.php, devmode.js or visit the web sourcecode of thesis.digitale-grafik

#### TitleAnimations
Some little messages that appear in the title of the website after loading. 


## Notes for future development
Here are some guidelines in casd you should decide to develop a theme, feature, etc. for this website. Mostly it's what I already said in __thesis.digitale-grafik as a framework__. You are free to add any additional features or themes for this website, if you want to make them available for everyone. 

In case of a general redesign for this website in the future please add the original css I wrote as the "legacy1.0" theme. 
That would be really great! Thanks ❤


## Credits
2024 – [cxxyyl](https://cxxyyl.xyz/), with addtional help from [OMDD](https://www.are.na/omdd)
This website uses [Kirby CMS](https://getkirby.com/)