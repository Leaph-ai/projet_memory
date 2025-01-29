export const exportResults = async (score, date, difficulty_level) => {
    const response = await fetch(`index.php?component=cards&action=export&score=${score}&date=${date}&difficulty_level=${difficulty_level}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    return await response.json()
}