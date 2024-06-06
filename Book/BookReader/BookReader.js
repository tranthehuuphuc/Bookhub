document.addEventListener('DOMContentLoaded', () => {
    const bookReader = document.getElementById('book-reader');
    const bookView = document.getElementById('book-view');
    const fullscreenBtn = document.getElementById('fullscreen-btn');
    const pageLeft = document.getElementById('page-left');
    const pageRight = document.getElementById('page-right');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const fontSizeSelect = document.getElementById('font-size');
    const fontFamilySelect = document.getElementById('font-family');
    const backgroundColorSelect = document.getElementById('background-color');

    let currentPage = 0;
    let bookText = [];
  // Extract book_id from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const bookId = urlParams.get('book_id');

// Fetch book information from the server
fetch(`get_books.php?book_id=${bookId}`)
    .then(response => response.json())
    .then(data => {
        console.log('Received data:', data); // Log the received data
        if (data.exists) {
            // Book exists in mybooks table, display the PDF viewer
            openBook(data.book); // Assuming only one book is returned
        } else {
            // Book does not exist or no books found, redirect user
            const redirectUrl = `../BookDetail/BookDetail.php?book_id=${bookId}`;
            window.location.href = redirectUrl;
        }
    })
    .catch(error => {
        console.error('Error checking book:', error);
    });

function openBook(book) {
    console.log('Opening book:', book); // Log the book object
    const pdfUrl = `../../admin/files/${book.book_file}`;
    parsePDFText(pdfUrl);
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
            pageLeft.innerHTML = leftPage ? `<p>${leftPage.text}</p><span class="page-number">${leftPage.page}</span>` : '';
            pageRight.innerHTML = '';
        } else {
            pageLeft.innerHTML = leftPage ? `<p>${leftPage.text}</p><span class="page-number">${leftPage.page}</span>` : '';
            pageRight.innerHTML = rightPage ? `<p>${rightPage.text}</p><span class="page-number">${rightPage.page}</span>` : '';
        }
    
        pageLeft.scrollTop = 0;
        pageRight.scrollTop = 0;
    
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
        const swipeThreshold = 80;
        const edgeThreshold = 20;

        if (Math.abs(touchDiff) > swipeThreshold) {
            if (touchStartX < window.innerWidth && touchDiff < 0) {
                turnPage('next');
            } else if (touchStartX < window.innerWidth && touchDiff > 0) {
                turnPage('prev');
            }
        } else if (touchStartX < edgeThreshold || touchStartX > window.innerWidth - edgeThreshold) {
            toggleFullscreen();
        }
    }

    const nextButton = document.querySelector('#next-btn');
    const prevButton = document.querySelector('#prev-btn');

    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowRight') {
            nextButton.click();
        } else if (event.key === 'ArrowLeft') {
            prevButton.click();
        }
    });

    prevBtn.addEventListener('click', () => turnPage('prev'));
    nextBtn.addEventListener('click', () => turnPage('next'));
    fullscreenBtn.addEventListener('click', toggleFullscreen);
    fontSizeSelect.addEventListener('change', updateSettings);
    fontFamilySelect.addEventListener('change', updateSettings);
    backgroundColorSelect.addEventListener('change', updateSettings);
});
