document.addEventListener("DOMContentLoaded", () => {
    const parentElement = document.querySelector(".parent")
    const backCardImage = "Assets/images/backcard.png"
    const countdown = document.querySelector(".countdown")
    const progressBar = document.querySelector(".progress-bar")
    const level1Btn = document.querySelector("#button_level1")
    const level2Btn = document.querySelector("#button_level2")
    const level3Btn = document.querySelector("#button_level3")

    let firstCard = null
    let secondCard = null
    let lock = false
    let gameStarted = false
    let matchedPairs = 0
    let numberOfCard = 20

    let startMinutes = 5
    let time = startMinutes * 60
    let totalTime = time
    let difficultyLevel = 1

    let timerInterval

    const startButton = document.querySelector("#start_button")
    const resetButton = document.querySelector("#reset_button")





    const updateGridLayout = (columns) => {
        const rows = 4
        parentElement.style.gridTemplateColumns = `repeat(${columns}, 1fr)`
        parentElement.style.gridTemplateRows = `repeat(${rows}, 1fr)`
    }

    const createCards = () => {
        parentElement.innerHTML = ""

        const images = []
        for (let i = 1; i <= (numberOfCard / 2); i++) {
            const imageName = `Assets/images/card${i}.png`
            images.push(imageName, imageName)
        }

        for (let i = images.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [images[i], images[j]] = [images[j], images[i]]
        }

        for (let i = 0; i < numberOfCard; i++) {
            const card = document.createElement("div")
            card.className = `card-${i + 1}`
            card.dataset.card = images[i] || ""


            card.style.backgroundImage = `url('${backCardImage}')`

            card.addEventListener("click", () => {
                if (!gameStarted) return
                handleCardClick(card)
            })

            parentElement.appendChild(card)
        }
    }


    const exportResults = async (score, date, difficulty_level) => {
        const response = await fetch(`index.php?component=cards&action=export&score=${score}&date=${date}&difficulty_level=${difficulty_level}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        return await response.json()
    }

    const handleCardClick = async (card) => {
        if (lock) return
        if (card.dataset.revealed === "true") return

        card.style.backgroundImage = `url('${card.dataset.card}')`
        card.dataset.revealed = "true"

        if (!firstCard) {
            firstCard = card
        } else if (!secondCard) {
            secondCard = card

            if (firstCard.dataset.card === secondCard.dataset.card) {
                matchedPairs = matchedPairs + 2
                firstCard = null
                secondCard = null

                if (matchedPairs === numberOfCard) {
                    clearInterval(timerInterval)
                    startButton.innerHTML = "Gagné !"
                    resetButton.innerHTML = "Rejouer"
                    const finalScore = `${totalTime - time}`

                    const query = await exportResults(finalScore, formatDate(currentDate), difficultyLevel)
                    console.log(query)
                }
            } else {
                lock = true
                setTimeout(() => {
                    firstCard.style.backgroundImage = `url('${backCardImage}')`
                    secondCard.style.backgroundImage = `url('${backCardImage}')`
                    firstCard.dataset.revealed = "false"
                    secondCard.dataset.revealed = "false"
                    firstCard = null
                    secondCard = null
                    lock = false
                }, 1000)
            }
        }
    }

    const updateCountdown = () => {
        if (time >= 0) {
            const minutes = Math.floor(time / 60)
            let seconds = time % 60

            seconds = seconds < 10 ? `0${seconds}` : seconds

            countdown.innerHTML = `${minutes}:${seconds}`

            const percent = (time / totalTime) * 100
            progressBar.style.width = `${percent}%`
            progressBar.setAttribute("aria-valuenow", Math.floor(percent))

            time--
        } else {
            clearInterval(timerInterval)
            countdown.innerHTML = "Temps écoulé !"
        }
    }

    const handleLevelBtnClick = (clickedButton, otherButtons) => {
        clickedButton.disabled = true
        clickedButton.classList.remove("btn-primary")
        clickedButton.classList.add("btn-secondary")

        otherButtons.forEach(button => {
            button.disabled = false
            button.classList.remove("btn-secondary")
            button.classList.add("btn-primary")
        })
    }

    const resetTimeForLevel = (minutes) => {
        startMinutes = minutes
        time = startMinutes * 60
        totalTime = time
    }

    if(startButton) {
        startButton.addEventListener("click", () => {
            startButton.disabled = true
            startButton.innerHTML = "Bonne chance !"
            gameStarted = true
            if (!timerInterval) {
                timerInterval = setInterval(updateCountdown, 1000)
            }


            level3Btn.disabled = true
            level2Btn.disabled = true
            level1Btn.disabled = true
        })
    }

    if(resetButton) {
        resetButton.addEventListener("click", () => {
            location.reload()
        })
    }

    if(level1Btn) {
        level1Btn.addEventListener("click", () => {
            handleLevelBtnClick(level1Btn, [level2Btn, level3Btn])
            resetTimeForLevel(5)
            updateGridLayout(5)
            numberOfCard = 20
            difficultyLevel = 1
            countdown.innerHTML = `5:00`
            createCards()
        })
    }

    if(level2Btn) {
        level2Btn.addEventListener("click", () => {
            handleLevelBtnClick(level2Btn, [level1Btn, level3Btn])
            resetTimeForLevel(4.5)
            updateGridLayout(6)
            numberOfCard = 24
            difficultyLevel = 2
            countdown.innerHTML = `4:30`
            createCards()
        })
    }

    if(level3Btn) {
        level3Btn.addEventListener("click", () => {
            handleLevelBtnClick(level3Btn, [level1Btn, level2Btn])
            resetTimeForLevel(4)
            updateGridLayout(7)
            numberOfCard = 28
            difficultyLevel = 3
            countdown.innerHTML = `4:00`
            createCards()
        })
    }
    const currentDate = new Date()

    const formatDate = (date) => {
        const year = date.getFullYear()
        const month = String(date.getMonth() + 1).padStart(2, '0')
        const day = String(date.getDate()).padStart(2, '0')

        return `${year}-${month}-${day}`
    };

    



    updateGridLayout(5)
    createCards()



})