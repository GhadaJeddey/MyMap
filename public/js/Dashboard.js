let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

function logout () {
  window.location.href="../../HomePage/home.php";
}

function logoutDash () {
  window.location.href="../HomePage/home.php";
}

function addTask()
{
  const inputBox=document.getElementById("input-box");
  const listContainer=document.getElementById("list-container");
  let li = document.createElement("li") ;
  li.innerHTML = inputBox.value ; 
  listContainer.appendChild(li);
  let span = document.createElement("span");
  span.innerHTML="\u00d7";
}