let character= document.getElementById("character");
let block= document.getElementById("block");
let score = 0;
let scoreDisplay = document.getElementById("score");
let scoreTimer;
function start(){
    if(block.classList != "blockAnimate"){
        block.classList.add("blockAnimate");
        startScore();
    }
}
function replay(){
    if(block.style.display=== "none"){
        block.style.display= "block";
    }
}
function jump(){
    if(character.classList != "animate"){
        character.classList.add("animate");
    }
    setTimeout(function(){
        character.classList.remove("animate");
    }, 500);
}
let checkDead= setInterval(function(){
    const characterTop= parseInt(window.getComputedStyle(character).getPropertyValue("top"));
    const blockLeft= parseInt(window.getComputedStyle(block).getPropertyValue("left"));
    if(blockLeft< 20 && blockLeft>0 && characterTop>= 130){
        block.classList.remove("blockAnimate");
        block.style.display = "none";
        stopScore();
        alert("Anda Kalah! Skor Anda: " + score);
    }
}, 10);

function startScore() {
    clearInterval(scoreTimer);
    score = 0;
    scoreDisplay.innerHTML = "Score: " + score;
    scoreTimer = setInterval(() => {
        score++;
        scoreDisplay.innerHTML = "Score: " + score;
    }, 500);
}

function stopScore() {
    clearInterval(scoreTimer);
}