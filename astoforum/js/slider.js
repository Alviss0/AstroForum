function slider() {

    const btn_left = Array.from(document.querySelectorAll('.slide-left'));
    const btn_right = Array.from(document.querySelectorAll('.slide-right'));
    const slides = document.querySelectorAll('.slides');

    btn_left.map((btn, index) => btn.addEventListener('click', () => left_click(index)))
    btn_right.map((btn, index) => btn.addEventListener('click', () => right_click(index)))

    setInterval(() => left_click(0), 7000)
    setInterval(() => left_click(1), 7000)

    function left_click(index) {
        let children = Array.from(slides[index].children);
        let children_swapped = '';
        for (let i = 0; i < children.length - 1; i++) {
            children = swap(children, i, i + 1);
        }
        children.forEach(child => children_swapped += child.outerHTML);
        slides[index].innerHTML = children_swapped;
    }

    function right_click(index) {
        let children = Array.from(slides[index].children);
        let children_swapped = '';
        for (let i = children.length - 1; i > 0; i--) {
            children = swap(children, i, i - 1);
        }
        children.forEach(child => children_swapped += child.outerHTML);
        slides[index].innerHTML = children_swapped;
    }
}

function swap(arr, first, second) {
    let tmp = arr[first];
    arr[first] = arr[second];
    arr[second] = tmp;
    return arr;
}

slider(0);

