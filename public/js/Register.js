
    
function mouseEnter(id){
    if(id=="signIn")
    {
        document.getElementById(id).style.textDecoration="underline";
    }
    else if (id=="menu"){
        document.getElementById("logo").style.color="black" ;
        document.querySelector('#title p').style.color="black" ;

    }
    else if (id=="btn")
    {
        document.getElementById(id).style.backgroundColor = "black";
        document.getElementById(id).style.color = "white";
    }
}

function mouseLeave(id){
    if(id=="signIn")
    {
        document.getElementById(id).style.textDecoration="none";
    }
    else if (id=="menu"){
        document.getElementById("logo").style.color="white" ;
        document.querySelector('#title p').style.color="white" ;

    }
    else {
        document.getElementById(id).style.backgroundColor = "white";
        document.getElementById(id).style.color = "black";
    }
}

function redirect()
{
    window.location.href="{{path('home') }}" ;
}
