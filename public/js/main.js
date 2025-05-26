document.addEventListener('DOMContentLoaded', () => {
    const fontSizeInput = document.getElementById('fontSize');
    const fontColorInput = document.getElementById('fontColor');

    document.getElementById('knopka').addEventListener('click', () => {
        loadTextPositions(); // Загружаем текстовые элементы из localStorage
        drawAll();           // Отрисовываем их поверх текущего изображения
    });
    
    if (!sessionStorage.getItem('sessionActive')) {
        // Это новое открытие вкладки → очищаем локальное хранилище текста
        localStorage.removeItem('textItems');
        // Устанавливаем флаг активной сессии
        sessionStorage.setItem('sessionActive', 'true');
    }
    // остальной код загрузки текста
    loadTextPositions();


    let isDragging = false;
    const switches = document.querySelectorAll('.switch');
    const underline = document.querySelector('.underline');
    switches.forEach(switchElement => {
        switchElement.addEventListener('click', () => {
            switches.forEach(el => el.classList.remove('active'));
            switchElement.classList.add('active');

            if (switchElement.dataset.side === 'left') {
                underline.classList.add('left');
                underline.classList.remove('right');
            } else {
                underline.classList.add('right');
                underline.classList.remove('left');
            }
        });
    });

    const openTemplatesMenuButton = document.querySelector('.open-menu[data-target="templates"]');
    const templatesSidebar = document.querySelector('.sidebar.templates');
    openTemplatesMenuButton?.addEventListener('click', () => {
        templatesSidebar.classList.add('open');
    });

    const closeTemplatesMenuButton = document.querySelector('.sidebar.templates .close-menu');
    closeTemplatesMenuButton?.addEventListener('click', () => {
        templatesSidebar.classList.remove('open');
    });

    const framesSidebar = document.querySelector('.sidebar.frames');
    document.querySelectorAll('.category-option').forEach(option => {
        option.addEventListener('click', function () {
            framesSidebar.classList.add('open');
            const categoryMenu = document.getElementById('category-menu');
            if (categoryMenu) {
                categoryMenu.classList.remove('open');
            }
        });
    });

    const closeFramesMenuButton = document.querySelector('.sidebar.frames .close-menu');
    closeFramesMenuButton?.addEventListener('click', () => {
        framesSidebar.classList.remove('open');
    });


    const categoryButtons = document.querySelectorAll('.icon-btn');
    const categoryMenu = document.getElementById('category-menu');
    const categoryList = document.getElementById('category-list');

    const categoryData = {
        "button1": [
            { category: "Category 1", text: "Выбрать" },
            { category: "Category 2", text: "Загрузить" },
            { category: "Category 3", text: "Без лого" }
        ],
        "button2": [
            { category: "Category A", text: "Рамки" },
            { category: "Category B", text: "Цвет" },
            { category: "Category C", text: "Герб" }
        ],
        "button3": [
            { category: "Category X", text: "Открыть фото", type: "file" },
            { category: "Category Y", text: "Скачать фото" }
        ],
        "button4": [
            { category: "Category M", text: "Редактировать заголовок" },
        ]
    };

    function populateCategories(buttonId) {
        const categories = categoryData[buttonId];
        categoryList.innerHTML = '';

        if (categories) {
            categories.forEach(cat => {
                const li = document.createElement('li');

                if (cat.type === 'file') {
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.accept = 'image/*';
                    fileInput.classList.add('category-file-input');
                    fileInput.addEventListener('change', function (event) {
                        handleImageUpload(event);
                    });
                    li.appendChild(fileInput);
                } else {
                    const button = document.createElement('button');
                    button.classList.add('category-option');
                    button.setAttribute('data-category', cat.category);
                    button.textContent = cat.text;
                    li.appendChild(button);
                }

                categoryList.appendChild(li);
            });

            document.querySelectorAll('.category-option').forEach(option => {
                option.addEventListener('click', function () {
                    const category = option.getAttribute('data-category');
                    const categoryNameElement = document.getElementById('category-name');
                    if (categoryNameElement) {
                        categoryNameElement.textContent = category;
                    }
                    if (categoryMenu) {
                        categoryMenu.classList.remove('open');
                    }
                    framesSidebar.classList.add('open');
                });
            });
        }
    }

    categoryButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const buttonId = button.getAttribute('data-button-id');
            populateCategories(buttonId);
            if (categoryMenu) {
                categoryMenu.classList.toggle('open');
            }
        });
    });

    document.addEventListener('click', function (event) {
        if (!categoryMenu.contains(event.target) && !event.target.matches('.icon-btn')) {
            categoryMenu.classList.remove('open');
        }
    });

    const canvas = document.getElementById('canvas');
    const ctx = canvas?.getContext('2d');
    const templateImages = document.querySelectorAll('.sidebar.templates .shablon-img');
    const frameImages = document.querySelectorAll('.sidebar.frames .shablon-img');

    const imageList = [];
    let currentIndex = 0;

    let currentImage = null;

    function displayImage(imageSrc) {
        if (!ctx) return;
    
        const img = new Image();
        img.onload = function () {
            const maxWidth = 600;
            const maxHeight = 800;
            let width = img.width;
            let height = img.height;
    
            if (width > maxWidth) {
                height = Math.round((maxWidth / width) * height);
                width = maxWidth;
            }
            if (height > maxHeight) {
                width = Math.round((maxHeight / height) * width);
                height = maxHeight;
            }
    
            canvas.width = width;
            canvas.height = height;
    
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, width, height);
    
            currentImage = img;
    
            // 🔴 НЕ ВЫЗЫВАЙ drawAll() здесь
        };
        img.src = imageSrc;
    }
    

    function drawAll() {
        if (!ctx || !currentImage) return;
    
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(currentImage, 0, 0, canvas.width, canvas.height);
    
        textItems.forEach(item => {
            ctx.font = `${item.size}px Arial`;
            ctx.fillStyle = item.color;
            ctx.fillText(item.text, item.x, item.y);
        });
    }
    
    

    templateImages.forEach(image => {
        image.addEventListener('click', () => {
            const imageSrc = image.getAttribute('src');
            console.log("Выбранное изображение:", imageSrc);
            imageList.push(imageSrc);
            displayImage(imageSrc);
            currentIndex = imageList.length - 1;
        });
    });

    frameImages.forEach(image => {
        image.addEventListener('click', () => {
            const imageSrc = image.getAttribute('src');
            imageList.push(imageSrc);
            displayImage(imageSrc);
            currentIndex = imageList.length - 1;
        });
    });

    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (imageList.length > 0 && currentIndex > 0) {
                currentIndex--;
                displayImage(imageList[currentIndex]);
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (imageList.length > 0 && currentIndex < imageList.length - 1) {
                currentIndex++;
                displayImage(imageList[currentIndex]);
            }
        });
    }

    if (ctx) {
        ctx.fillStyle = "#f0f0f0";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    }

    document.addEventListener('keydown', (event) => {
        if (event.ctrlKey && event.code === 'KeyZ') {
            console.log('Ctrl+Z pressed');
            if (imageList.length > 0 && currentIndex > 0) {
                currentIndex--;
                displayImage(imageList[currentIndex]);
                event.preventDefault();
            }
        } else if (event.ctrlKey && event.code === 'KeyY') {
            console.log('Ctrl+Y pressed');
            if (imageList.length > 0 && currentIndex < imageList.length - 1) {
                currentIndex++;
                displayImage(imageList[currentIndex]);
                event.preventDefault();
            }
        }
    });

  
    const textInput = document.getElementById('text-input');
    const addTextButton = document.getElementById('knopka');
    console.log(addTextButton);
    let currentText = '';
    let textX = 50, textY = 50;
    let isEditing = false;
    let selectedText = null; 

    let textItems = [];

    let textSize = parseInt(fontSizeInput.value);
    let textColor = fontColorInput.value;

 
    addTextButton.addEventListener('click', () => {
        const inputText = textInput.value.trim();
        const textSize = parseInt(fontSizeInput.value);
        const textColor = fontColorInput.value;
    
        if (!inputText) {
            alert('Введите текст!');
            return;
        }
    
        const newText = {
            text: inputText,      // ✅ Теперь берёт из input
            x: textX,
            y: textY,
            size: textSize,       // ✅ Теперь берёт из input
            color: textColor      // ✅ Теперь берёт из input
        };
    
        textItems.push(newText);
        drawAll();
        textX += 20;
        textY += 30;
        saveTextPositions();
        createEditableTextBlock(newText); // если у тебя есть функция для визуального блока
   
        textInput.value = "";
    });
    

    canvas.addEventListener('mousedown', (event) => {
        const mouseX = event.offsetX;
        const mouseY = event.offsetY;
    
        selectedText = null;
        textItems.forEach(textObj => {
            if (mouseX >= textObj.x && mouseX <= textObj.x + 100 && mouseY >= textObj.y - 30 && mouseY <= textObj.y) {
                selectedText = textObj;
                isDragging = true;
                offsetX = mouseX - textObj.x;
                offsetY = mouseY - textObj.y;
            }
        });
    });

    canvas.addEventListener('mousemove', (event) => {
        if (isDragging && selectedText) {
            selectedText.x = event.offsetX - offsetX;
            selectedText.y = event.offsetY - offsetY;
            drawAll();
        }
    });

    canvas.addEventListener('mouseup', () => {
        if (isDragging && selectedText) {
            saveTextPositions();
        }
        isDragging = false;
        selectedText = null;
    });

    function saveTextPositions() {
        localStorage.setItem('textItems', JSON.stringify(textItems));
    }
    
    function loadTextPositions() {
        const savedText = localStorage.getItem('textItems');
        if (savedText) {
            textItems = JSON.parse(savedText);
        }
    }

    loadTextPositions();
    document.getElementById('imageUpload').addEventListener('change', handleImageUpload);

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.getElementById('canvas');
                const ctx = canvas.getContext('2d');
                const maxWidth = 600;
                const maxHeight = 800;
                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height = Math.round((maxWidth / width) * height);
                    width = maxWidth;
                }
                if (height > maxHeight) {
                    width = Math.round((maxHeight / height) * width);
                    height = maxHeight;
                }

                canvas.width = width;
                canvas.height = height;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, width, height);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    };
});
