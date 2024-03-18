let products = {
    data: [
        {
            productName: 'Điều kỳ diệu của tiệm tạp hóa Namiya',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Sách',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Thể loại',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Thể loại',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 2',
            category: 'Tác giả',
            price: '100.000',
            image: '../assets/biasachvd1.jpg',
        },
        {
            productName: 'Sách 3',
            category: 'Tác giả',
            price: '100.000',
            image: '../assets/biasachvd.jpg',
        },
        {
            productName: 'Sách 4',
            category: 'Thảo luận',
            price: '100.000',
            image: '../assets/biasachvd.jpg',
        },
    ],
};

for (let i of products.data) {
    //Create Card
    let card = document.createElement("div");
    //Card should have category and should stay hidden initially
    card.classList.add("card", i.category.toLowerCase().replace(/\s+/g, '_'), "hide");
    //image div
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");
    //img tag
    let image = document.createElement("img");
    image.setAttribute("src", i.image);
    imgContainer.appendChild(image);
    card.appendChild(imgContainer);
    //container
    let container = document.createElement("div");
    container.classList.add("container");
    //product name
    let name = document.createElement("h4");
    name.classList.add("product-name");
    name.innerText = i.productName.toUpperCase();
    container.appendChild(name);
    //price
    let price = document.createElement("h3");
    price.innerText = i.price + 'đ';
    container.appendChild(price);
    card.appendChild(container);
    document.getElementById("products").appendChild(card);
  }

  //parameter passed from button (Parameter same as category)
  function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach((button) => {
      //check if value equals innerText
      if (value.toUpperCase() === button.innerText.toUpperCase()) {
        button.classList.add("active");
      } else {
        button.classList.remove("active");
      }
    });

    //select all cards
    let elements = document.querySelectorAll(".card");
    //loop through all cards
    elements.forEach((element) => {
      //display all cards on 'all' button click
      if (value === "all") {
        element.classList.remove("hide");
      } else {
        //Check if element contains category class
        if (element.classList.contains(value.toLowerCase().replace(/\s+/g, '_'))) {
          //display element based on category
          element.classList.remove("hide");
        } else {
          //hide other elements
          element.classList.add("hide");
        }
      }
    });
  }

  function searchProduct() {
    let searchInput = document.getElementById("search-input").value;
    let elements = document.querySelectorAll(".product-name");
    let cards = document.querySelectorAll(".card");
    
    elements.forEach((element, index) => {
      if (element.innerText.includes(searchInput.toUpperCase())) {
        cards[index].classList.remove("hide");
      } else {
        cards[index].classList.add("hide");
      }
    });
  }

  document.getElementById("search-input").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        searchProduct();
    }
    });
  document.getElementById("search").addEventListener("click", searchProduct);

  //Initially display all products
  window.onload = () => {
    filterProduct("all");
  };