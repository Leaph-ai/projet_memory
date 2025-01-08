document.addEventListener("DOMContentLoaded", () => {
    const allCards = document.querySelectorAll(".parent > div")
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


    allCards.forEach((card, index) => {
        if (images[index]) {
            card.dataset.card = images[index]; // Stocker l'image réelle en tant que data (identifiant)
        }

        card.style.backgroundImage = `url('${backCardImage}')`

        card.addEventListener("click", () => {
            handleCardClick(card); // Appeler la fonction pour gérer le clic
        })
    })

    function handleCardClick(card) {
        if (lock) return
        if (card.dataset.revealed === "true") return

        card.style.backgroundImage = `url('${card.dataset.card}')`
        card.dataset.revealed = "true"

        if (!firstCard) {
            firstCard = card
        } else if (!secondCard) {
            secondCard = card

            if (firstCard.dataset.card === secondCard.dataset.card) {
                console.log("Paire trouvée !")
                firstCard = null
                secondCard = null
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
})