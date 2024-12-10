<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ul{
padding:0;
list-style:none;
}
li{
padding:0.5em 0 0 1em;
border-top:1px solid #666;
position:relative;
}
li:before,
li:after{
content:"";
display:block;
height:0.5em;
width:0.5em;
border:3px solid #fff;
margin-top:-0.1em;
transform:rotate(45deg);
border-color: white;
}
li:before{
position:absolute;
top:-0.25em;
left:0;
}
li:after{
position:absolute;
top:-0.25em;
right:0;
}
    </style>
</head>
<body>
    
</body>
</html>

<ul>
<li>AAAAAAAA</li>
<li>BBBBBBBB</li><li>CCCCCCCC</li></ul>
