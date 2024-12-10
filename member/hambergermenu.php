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
border-top:3px solid #fff;
position:relative;
}
li:before,
li:after{
content:"";
display:block;
height:0.5em;
width:0.5em;
border:1px solid #666;
margin-top:-0.1em;
transform:rotate(45deg);
background:#fff;
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
