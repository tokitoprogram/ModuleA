const startButton  = document.getElementById("startButton")
const canvasContainer = document.getElementById("container")

startButton.addEventListener('click', initGame)
function initGame() {
    // d:none to start Button
    startButton.classList.add('none')
  
    // init Game

    let game = {
        active: false,
        player : {
            x:375,
            y:580,
            width:50,
            height:50,
            speed: 7,
            counter: 0
        },
        coins : [

        ],
        coin : {
            y: -50,
            width: 30,
            height: 30,
            speed: 4,
        },
        asteroids : [],
        asteroid : {
            y: -50,
            width: 50,
            height: 50,
            speed: 3
        },
        keys: {}        
    }
 

    const canvas = document.getElementById('playGround')
    const ctx = canvas.getContext("2d")
    canvas.classList.remove('none')

    
    game.active = true


    // init keyup and keydown
    document.addEventListener('keydown', function(e) {
        game.keys[e.key] = true;

    }) ;
    document.addEventListener('keyup', function(e) {
        game.keys[e.key] = false;
    })
    let asteroidImg = new Image()
    asteroidImg.src = '../assets/images/asteroid.png'
    let coinImg = new Image()
    coinImg.src = '../assets/images/coin.png'
    function gameLoop() {
        if (!game.active) {return}
            update()
            draw()
            requestAnimationFrame(gameLoop)
        
    }
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    function isColliding(asteroid, player) {
        return asteroid.x < player.x + player.width &&
            asteroid.x + asteroid.width > player.x &&
            asteroid.y - 50 < player.y + player.height &&
            asteroid.y > player.y;
    }
    let objectsIntervalId = setInterval(function() {
        let iCoin = 0;
        let iAsteroid = 0;
        
        asteroid = {
            x: getRandomInt(50, (canvas.width-100)),
            y: game.asteroid.y, 
        }
        coinId = {
            x: getRandomInt(50, (canvas.width-100)),
            y: game.coin.y,        
        }
        game.asteroids.push(asteroid)
        game.coins.push(coinId)
    }, 2000)
    function update() {
        if (game.keys['ArrowLeft'] && game.player.x > 0) {
            if (game.player.x - game.player.speed < 50) {
                game.player.x += game.player.speed
                
            } else {
                game.player.x -= game.player.speed
            }
        }
        if (game.keys['ArrowRight'] && game.player.x > 0  ) {
            if (game.player.x + game.player.speed < (canvas.width - 100)) {
                game.player.x += game.player.speed
                
            } else {
                game.player.x-= game.player.speed
            }
        }
        
        game.asteroids.forEach((ast, index) => {
            ast.y += game.asteroid.speed;


            if (isColliding(
                { x: game.player.x, y: game.player.y, width: 50, height: 50 }, 
                { x: ast.x, y: ast.y, width: game.asteroid.width, height: game.asteroid.height }
            )) {
                gameOver(); 
            }
            if (ast.y > canvas.height) {
                game.asteroids.splice(index, 1);
            }
        });
        game.coins.forEach((coin, index)=> {
            coin.y += game.coin.speed;

            if (isColliding(
                {x: game.player.x, y: game.player.y, width: 50, height:50},
                {x: coin.x, y: coin.y, width: game.coin.width, height: game.coin.height}
            )) {
                game.player.counter +=1;
                game.coins.splice(index, 1)
            }
            if (coin.y > canvas.height) {
                game.coins.splice(index, 1)
            }
        })

    }


    function gameOver() {
        game.player.speed = 0;
        game.asteroid.speed = 0;
        game.coin.speed = 0;
        clearInterval(objectsIntervalId)
        game.active = true

    }

    function draw() {
        ctx.clearRect(0,0, canvas.width, canvas.height)


        ctx.beginPath();
        ctx.fillStyle = "blue"
        ctx.moveTo(game.player.x, game.player.y);
        ctx.lineTo(game.player.x + 25, game.player.y - 50)
        ctx.lineTo(game.player.x + 50, game.player.y)
        ctx.fill();
        
        // asteroid

        game.asteroids.forEach(ast => {
            ctx.drawImage(asteroidImg, ast.x, ast.y, game.asteroid.width, game.asteroid.height);
        });
        game.coins.forEach (coin => {
            ctx.drawImage(coinImg, coin.x, coin.y, game.coin.width, game.coin.height);
        }); 
    }

    requestAnimationFrame(gameLoop)

}
