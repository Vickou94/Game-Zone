// Je recupère le canvas de ma page html

const canvas = document.querySelector('#game');
const ctx = canvas.getContext('2d');

// Je crée un bouton pour relancer une partie
const start = document.querySelector('.refresh');
start.addEventListener('click', refreshPage);

// J'empêche la page de bouger lorsque j'utilise les flêches du clavier
window.addEventListener("keydown", function(e) {
    if(["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);

// Je crée une classe pour les parties qui vont venir agrandir mon serpent
class Snakepart{
    constructor(x, y){
        this.x = x;
        this.y = y;
    }
}

// Je déclare une variable speed pour la vitesse du jeu (qu'on pourra augmenter par la suite)
let speed = 7;

// Nombre de "cases" en hauteur/largeur = 25x25
let tileCount = 25;
let tileBlock = canvas.width / tileCount;
//Dimensions d'une "case"
let tileSize =  tileBlock - 2;

// Position du serpent dans le canvas au lancement
let headX = 14;
let headY = 14;
const snakeParts = [];
let tailLength = 2;

// Position de la première pomme dans mon canvas
let appleX = 5;
let appleY= 5;

// Je crée deux variables pour gerer les déplacements du serpent en x et en y
let xVelocity = 0;
let yVelocity = 0;

// Je déclare une variable score pour compter les points
let score = 0;

// Je déclare deux constantes audio, une lorsque le serpent mange une pomme, l'autre lorsque le joueur perd la partie
const eat = new Audio("resources/sound/eatapple.mp3");
const lose = new Audio("resources/sound/lose.mp3");

function refreshPage() {
    window.location.reload();
}

function drawGame() {
    moveSnake();
    let result = isGameOver();
    if(result){
        return;
    }
    clearScreen();
    
    checkAppleCollision();
    drawApple();
    drawSnake();
    drawScore();

    //J'augmente la vitesse du serpent en fonction du score

    if(score > 5) {
        speed = 9;
    }
    
    if(score > 10) {
        speed = 11
    }

    setTimeout(drawGame, 1000/ speed);
}

function isGameOver() {
    let gameOver = false;

    //Pour éviter d'avoir gameover au lancement du jeu, je donne une condition pour la position initiale du serpent
    if(yVelocity ===0 && xVelocity ===0){
        return gameOver = false;
    }

    //Taper un mur
    if (headX < 0) {
        gameOver = true;
    }
    
    else if (headX >= tileCount) {
        gameOver = true;
    }

    else if (headY < 0) {
        gameOver = true;
    }

    else if (headY >= tileCount) {
        gameOver = true;
    }
    //Si le serpent entre en collision avec une partie de son corps
    for(let i = 0; i < snakeParts.length; i++) {
        let part = snakeParts[i];
        if(part.x === headX && part.y === headY) {
            gameOver = true;
            break;
        }
    }

    //On affiche Game Over en cas de défaite
    if(gameOver) {
        ctx.fillStyle = 'red';
        ctx.font = "50px Verdana";
        ctx.fillText("Game Over !", canvas.width / 4.5, canvas.height / 2);
        lose.play();
        
    }

    return gameOver;
}



//On affiche le score en haut à droite du canvas
function drawScore() {
    ctx.fillStyle = 'white';
    ctx.font = '15px Verdana';
    ctx.fillText('Score ' + score, canvas.width-80, 20);
}

//On applique un fond noir au canvas
function clearScreen() {
    ctx.fillStyle = 'black';
    ctx.fillRect(0,0, canvas.width, canvas.height);
}

//On dessine le serpent
function drawSnake() {

    //Nouvelles parties du serpent
    ctx.fillStyle = 'forestgreen';
    for(let i=0; i < snakeParts.length; i++){
        let part = snakeParts[i];
        ctx.fillRect(part.x * tileBlock, part.y * tileBlock, tileSize, tileSize);
    }

    snakeParts.push(new Snakepart(headX, headY));
    if(snakeParts.length > tailLength) {
        snakeParts.shift();
    }

    //Tête du serpent
    ctx.fillStyle = '#ccff00';
    ctx.fillRect(headX * tileBlock, headY * tileBlock, tileSize, tileSize);

}
//On dessine la pomme
function drawApple() {
    ctx.fillStyle = 'red';
    ctx.fillRect(appleX * tileBlock, appleY * tileBlock, tileSize, tileSize);
}
//Lorsque le serpent mange la pomme, une nouvelle apparait de facon aléatoire dans le canvas,
//on incrémente la taille du serpent ainsi que le score et on joue un son.
function checkAppleCollision() {
    if(appleX === headX && appleY === headY) {
        appleX = Math.floor(Math.random() * tileCount);
        appleY = Math.floor(Math.random() * tileCount);
        tailLength++;
        score++;
        eat.play();
    }
}

function moveSnake() {
    headX = headX + xVelocity;
    headY = headY + yVelocity;
}

document.body.addEventListener('keydown', keyDown);

function keyDown(event) {
    //Vers le haut
    if(event.keyCode == 38) {
    //Si le serpent monte alors il ne peut pas revenir en arrière (sinon il se mord)
    //On répète ce code pour le bas, la gauche et la droite.
        if (yVelocity == 1)
            return;
        yVelocity = -1;
        xVelocity = 0;
    }
    //Vers le bas
    if(event.keyCode == 40) {
        if (yVelocity == -1)
            return;
        yVelocity = 1;
        xVelocity = 0;
    }
    //Vers la gauche
    if(event.keyCode == 37) {
        if (xVelocity == 1)
            return;
        yVelocity = 0;
        xVelocity = -1;
    }
    //Vers la droite
    if(event.keyCode == 39) {
        if (xVelocity == -1)
            return;
        yVelocity = 0;
        xVelocity = 1;
    }
}



drawGame();
