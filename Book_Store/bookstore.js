function scrollLeft() {
    const container = document.querySelector('.pro-container');
    container.scrollBy({
        left: -200, // Điều chỉnh giá trị này để kiểm soát khoảng cách cuộn
        behavior: 'smooth'
    });
}

function scrollRight() {
    const container = document.querySelector('.pro-container');
    container.scrollBy({
        left: 200, // Điều chỉnh giá trị này để kiểm soát khoảng cách cuộn
        behavior: 'smooth'
    });
}