# idml-hyperlinks
1. Change IDML file extension to .zip and extract 
2. Go into IDMLfile/Stories/ and find largest Story_etc.xml - very scientific
3. Use path to that XML file in the line 3
4. Run PHP in browser, view source (yeah, it's great) and grab all Hyperlinks rows
5. Insert rows into IDMLfile/designmap.xml in between rows like these:
```
<idPkg:Story src="Stories/Story_u4db.xml" />

<IndexingSortOption Self="dIndexingSortOptionnkIndexGroup_Symbol" Name="$ID/kIndexGroup_Symbol" Include="true" Priority="0" HeaderType="Nothing" />
```
6. Save and close
7. Pack up file - I use ePubPack as zipping up the file does strange things to the mimetype or something that breaks the file
8. Change .epub to .idml
9. Attempt to open in InDesign! Quite often breaks InDesign, or the hyperlinks don't link up properly, but when it works it's great

InDesign IDML file - searches given Stories XML file for cover images named ISBN.jpg, extracts ISBN and spits out XML hyperlinks to be inserted into designmap.xml

Probably better in something other than PHP but was done quickly to help out marketing.

TO DO:
* Get Stories XML file name and URL base from command line
* Search for ISBN in file name without needing to specify what character it starts at
* Hyperlinks don't always link up properly for different styles of image, not sure why!
* Spit XML into file or something more useful - open designmap.xml and put hyperlinks in directly
