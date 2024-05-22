document.addEventListener('DOMContentLoaded', () => {
    const bookList = document.getElementById('book-list');
    const bookReader = document.getElementById('book-reader');
    const bookView = document.getElementById('book-view');
    const backBtn = document.getElementById('back-btn');
    const fullscreenBtn = document.getElementById('fullscreen-btn');
    const pageLeft = document.getElementById('page-left');
    const pageRight = document.getElementById('page-right');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const fontSizeSelect = document.getElementById('font-size');
    const fontFamilySelect = document.getElementById('font-family');
    const backgroundColorSelect = document.getElementById('background-color');

    const books = [
        { id: 1, title: 'Thất lạc cõi người', cover: './book-cover/book.jpg', format: 'pdf', content: './book.pdf' }
    ];

    let currentBook = null;
    let currentPage = 0;
    let bookText = [];

    function displayBookList() {
        bookList.innerHTML = '';
        books.forEach(book => {
            const bookItem = document.createElement('div');
            bookItem.classList.add('book-item');
            bookItem.innerHTML = `
                <img src="${book.cover}" alt="${book.title}">
                <h3>${book.title}</h3>
            `;
            bookItem.addEventListener('click', () => openBook(book));
            bookList.appendChild(bookItem);
        });
        bookList.style.display = 'flex';
        bookReader.style.display = 'none';
    }

    function openBook(book) {
        currentBook = book;
        if (book.format === 'pdf') {
            parsePDFText(book.content);
        } else {
            bookText = [{ page: 1, text: book.content }];
            currentPage = 0;
            renderPages();
        }
    }

    async function parsePDFText(pdfUrl) {
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        const pdf = await loadingTask.promise;
        bookText = [];
        
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);
            const textContent = await page.getTextContent();
            const pageText = textContent.items.map(item => item.str + '\n').join('');
            bookText.push({ page: pageNum, text: pageText });
        }
        
        currentPage = 0;
        renderPages();
    }

    function renderPages() {
        const leftPage = bookText[currentPage];
        const rightPage = bookText[currentPage + 1];
    
        if (window.innerWidth <= 1140) {
            // Only render the left page and show its page number
            pageLeft.innerHTML = leftPage ? `<p>${leftPage.text}</p><span class="page-number">${leftPage.page}</span>` : '';
            pageRight.innerHTML = '';
        } else {
            // Render both pages and show their page numbers
            pageLeft.innerHTML = leftPage ? `<p>${leftPage.text}</p><span class="page-number">${leftPage.page}</span>` : '';
            pageRight.innerHTML = rightPage ? `<p>${rightPage.text}</p><span class="page-number">${rightPage.page}</span>` : '';
        }
    
        pageLeft.scrollTop = 0; // Reset scroll position
        pageRight.scrollTop = 0; // Reset scroll position
    
        bookList.style.display = 'none';
        bookReader.style.display = 'block';
    }
    
    function turnPage(direction) {
        if (direction === 'next') {
            if (window.innerWidth <= 1140 && currentPage + 1 < bookText.length) {
                currentPage += 1;
            } else if (currentPage + 2 < bookText.length) {
                currentPage += 2;
            }
        } else if (direction === 'prev') {
            if (window.innerWidth <= 1140 && currentPage - 1 >= 0) {
                currentPage -= 1;
            } else if (currentPage - 2 >= 0) {
                currentPage -= 2;
            }
        }
        renderPages();
    }
    

    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            bookView.requestFullscreen().catch(err => {
                alert(`Error attempting to enable fullscreen mode: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    }

    function updateSettings() {
        const fontSize = fontSizeSelect.value;
        const fontFamily = fontFamilySelect.value;
        const backgroundColor = backgroundColorSelect.value;

        pageLeft.style.fontSize = fontSize;
        pageRight.style.fontSize = fontSize;
        pageLeft.style.fontFamily = fontFamily;
        pageRight.style.fontFamily = fontFamily;
        bookView.style.backgroundColor = backgroundColor;

        if (isDarkColor(backgroundColor)) {
            pageLeft.style.color = 'white';
            pageRight.style.color = 'white';
        } else {
            pageLeft.style.color = 'black';
            pageRight.style.color = 'black';
        }

        pageLeft.style.backgroundColor = backgroundColor;
        pageRight.style.backgroundColor = backgroundColor;
    }

    function isDarkColor(color) {
        const rgb = color.replace(/^#/, '');
        const r = parseInt(rgb.substring(0, 2), 16);
        const g = parseInt(rgb.substring(2, 4), 16);
        const b = parseInt(rgb.substring(4, 6), 16);
        const brightness = (r * 299 + g * 587 + b * 114) / 1000;
        return brightness < 128;
    }

    // Swipe detection for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    bookView.addEventListener('touchstart', (event) => {
        touchStartX = event.changedTouches[0].screenX;
    });

    bookView.addEventListener('touchend', (event) => {
        touchEndX = event.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const touchDiff = touchEndX - touchStartX;
        const swipeThreshold = 80; // Minimum distance in pixels to be considered a swipe
        const edgeThreshold = 20;  // Distance from the edge to consider as edge swipe

        if (Math.abs(touchDiff) > swipeThreshold) {
            if (touchStartX < window.innerWidth && touchDiff < 0) {
                // Swipe right from center
                turnPage('next');
            } else if (touchStartX < window.innerWidth && touchDiff > 0) {
                // Swipe left from center
                turnPage('prev');
            }
        } else if (touchStartX < edgeThreshold || touchStartX > window.innerWidth - edgeThreshold) {
            // Edge swipe
            toggleFullscreen();
        }
    }

    // Get references to your buttons (replace with actual IDs)
    const nextButton = document.querySelector('#next-btn');
    const prevButton = document.querySelector('#prev-btn');

    // Add event listener for keydown
    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowRight') {
            // Right arrow key pressed, trigger next button click
            nextButton.click();
        } else if (event.key === 'ArrowLeft') {
            // Left arrow key pressed, trigger prev button click
            prevButton.click();
        }
    });

    prevBtn.addEventListener('click', () => turnPage('prev'));
    nextBtn.addEventListener('click', () => turnPage('next'));
    backBtn.addEventListener('click', () => displayBookList());
    fullscreenBtn.addEventListener('click', toggleFullscreen);
    fontSizeSelect.addEventListener('change', updateSettings);
    fontFamilySelect.addEventListener('change', updateSettings);
    backgroundColorSelect.addEventListener('change', updateSettings);

    displayBookList();
});
