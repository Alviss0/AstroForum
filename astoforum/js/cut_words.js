function cut() {
    const topicTitles = document.querySelectorAll('.slider-block .slider:not(:last-child) .slide-text h1');
    const articleTitles = document.querySelectorAll('.slider-block .slider:last-child .slide-text h1');

    topicTitles.forEach(title => title.innerHTML.length > 40? title.innerHTML = title.innerHTML.slice(0, 41) + ' . . .': null)
    articleTitles.forEach(title => title.innerHTML.length > 60? title.innerHTML = title.innerHTML.slice(0, 61) + ' . . .': null)
}
cut()