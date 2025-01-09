document.addEventListener("DOMContentLoaded", () => {
    const parentElement = document.querySelector(".parent")
    const backCardImage = "Assets/images/backcard.png"

    let firstCard = null
    let secondCard = null
    let lock = false

    const images = [];
    for (let i = 1; i <= 18; i++) {
        const imageName = `Assets/images/card${i}.png`
        images.push(imageName, imageName)
    }

    for (let i = images.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [images[i], images[j]] = [images[j], images[i]]
    }

    for (let i = 0; i < 36; i++) {
        const card = document.createElement("div")
        card.className = `card-${i + 1}`
        card.dataset.card = images[i] || ""

        card.style.backgroundImage = `url('${backCardImage}')`

        card.addEventListener("click", () => {
            handleCardClick(card)
        })

        parentElement.appendChild(card)
    }

    const handleCardClick = (card) => {
        if (lock) return;
        if (card.dataset.revealed === "true") return;

        card.style.backgroundImage = `url('${card.dataset.card}')`;
        card.dataset.revealed = "true";

        if (!firstCard) {
            firstCard = card;
        } else if (!secondCard) {
            secondCard = card;

            if (firstCard.dataset.card === secondCard.dataset.card) {
                console.log("Paire trouvée !");
                firstCard = null;
                secondCard = null;
            } else {
                lock = true;
                setTimeout(() => {
                    firstCard.style.backgroundImage = `url('${backCardImage}')`;
                    secondCard.style.backgroundImage = `url('${backCardImage}')`;
                    firstCard.dataset.revealed = "false";
                    secondCard.dataset.revealed = "false";
                    firstCard = null;
                    secondCard = null;
                    lock = false;
                }, 1000);
            }
        }
    };

    const startMinutes = 1
    let time = startMinutes * 60
    const totalTime = time

    const countdownEl = document.querySelector(".countdown")
    const progressBar = document.querySelector(".progress-bar")

    const updateCountdown = () => {
        if (time >= 0) {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;

            seconds = seconds < 10 ? `0${seconds}` : seconds;

            countdownEl.innerHTML = `${minutes}:${seconds}`;

            const percent = (time / totalTime) * 100
            progressBar.style.width = `${percent}%`
            progressBar.innerHTML = `${Math.floor(percent)}%`
            progressBar.setAttribute("aria-valuenow", Math.floor(percent))

            time--
        } else {
            clearInterval(timerInterval)
            countdownEl.innerHTML = "Temps écoulé !"
        }
    }

    const timerInterval = setInterval(updateCountdown, 1000)

});