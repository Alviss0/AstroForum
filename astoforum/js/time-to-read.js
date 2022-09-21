const timeToRead = () => {
    const article = document.querySelector('.article-text pre');
    const time = document.querySelector('.time-to-read p span')
    const wordsCount = article.innerHTML.split(' ').length
    const timeInMinutes = Math.ceil(wordsCount/120)
    time.innerHTML = timeInMinutes.toString();


}
timeToRead()