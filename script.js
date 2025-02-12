let count = Number(document.querySelector(".bombCount").dataset.php)
let bombCount = count;
let startTime = new Date()
document.querySelector(".bombCount").innerHTML = `Bombs: ${count}`
document.addEventListener("DOMContentLoaded", function(){
    gameState()
    colorNumbers()
    placeFlag()
    clickCell()
})

const clickCell = () => {
    document.querySelectorAll("td").forEach(cell => {
        cell.addEventListener("click", function(){
            let child = this.querySelector(".content")
            let flag = this.querySelector(".flag")
            if(flag && flag.innerHTML !== ""){
                flag.innerHTML = ""
                count++
                document.querySelector(".bombCount").innerHTML = `Bombs: ${count}`
                flag.dataset.flag = "false"
            }
            if (child) {
                if(child.innerHTML.trim() === "X"){
                    score(false);
                }
                reveal(child)
            }
            checkWin()
        })
    })
}

const colorNumbers = () => {
    document.querySelectorAll(".content").forEach(number => {
        if (number) {
            switch (parseInt(number.innerHTML, 10)) {
                case 2:
                    number.style.color = "blue"
                    break;
                case 3:
                    number.style.color = "green"
                    break;
                case 4:
                    number.style.color = "red"
                    break;
                case 5:
                    number.style.color = "orange"
                    break;
                case 6:
                    number.style.color = "brown"
                    break;
                case 7:
                    number.style.color = "pink"
                    break;
                case 8:
                    number.style.color = "purple"
                    break;
                default:
                    break;
            }
        }
    })
}

const reveal = (tile) => {
    if (!tile || tile.dataset.revealed === "true") return;
    let flagElement = tile.parentElement.querySelector(".flag");
    if (flagElement && flagElement.dataset.flag === "true") return;
    tile.style.display = "inline"
    tile.parentElement.style.backgroundColor = "white"
    tile.dataset.revealed = "true"

    let [tens, ones] = tile.id.split("-").map(Number)

    let left = document.getElementById(`${tens}-${ones - 1}`)
    let right = document.getElementById(`${tens}-${ones + 1}`)
    let top = document.getElementById(`${tens - 1}-${ones}`)
    let bottom = document.getElementById(`${tens + 1}-${ones}`)

    let topLeft = document.getElementById(`${tens - 1}-${ones - 1}`)
    let topRight = document.getElementById(`${tens - 1}-${ones + 1}`)
    let bottomLeft = document.getElementById(`${tens + 1}-${ones - 1}`)
    let bottomRight = document.getElementById(`${tens + 1}-${ones + 1}`)

    if(!tile.textContent.trim()){
        if (left) reveal(left)
        if (right) reveal(right)
        if (top) reveal(top)
        if (bottom) reveal(bottom)
        
        if (topLeft) reveal(topLeft)
        if (topRight) reveal(topRight)
        if (bottomLeft) reveal(bottomLeft)
        if (bottomRight) reveal(bottomRight)
    }
}

const gameState = () => {
    const form = document.querySelector(".playForm")
    const nav = document.querySelector("nav")
    if(document.querySelectorAll(".content").length > 0){
        form.style.display = "none"
        nav.style.display = "flex"
    } else {
        form.style.display = "flex"
        nav.style.display = "none"
    }
}

const placeFlag = () => {
    document.querySelectorAll("td").forEach(cell => {
        cell.addEventListener("contextmenu", function(){
            let flag = cell.querySelector(".flag")
            if(flag.parentElement.querySelector(".content").dataset.revealed !== "true"){
                if(flag.innerHTML == ""){
                    flag.innerHTML = "&#128681"
                    flag.dataset.flag = "true"
                    count--
                    document.querySelector(".bombCount").innerHTML = `Bombs: ${count}`
                } else {
                    flag.innerHTML = ""
                    flag.dataset.flag = "false"
                    count++
                    document.querySelector(".bombCount").innerHTML = `Bombs: ${count}`
                }
            }
            checkWin()
        })
    })
}
const score = (win) => {
    document.querySelector(".modal").style.display = "flex"
    document.querySelector("table").style.display = "none"
    let stats = {
        name: "",
        time: new Date() - startTime,
        bombsFound: bombCount - count,
        bombsAll: bombCount,
        win: win,
        boardSize: document.querySelectorAll("td").length
    }

    let submit = document.querySelector(".submitScore")
    submit.addEventListener("click", function(e){
        e.preventDefault()
        stats.name = document.querySelector(".nameInput").value
        fetch("data/post.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(stats)
        })
        .then(response => response.json())
        .then(data => {
            console.log("Server Response:", data)
            window.location.href = "index.php"
        })
        .catch(error => console.error("Error:", error))
    })
}

const checkWin = () => {
    let allBombsFlagged = true
    document.querySelectorAll("td").forEach(cell => {
        let isFlagged = cell.querySelector(".flag").dataset.flag === "true"
        let isMine = cell.querySelector(".content").innerHTML.trim() === "X"

        if (isMine && !isFlagged) {
            allBombsFlagged = false
        }
    })

    if (allBombsFlagged) {
        score(true)
    }
}
