<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            margin-bottom: 20px;
        }

        .scroll-wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }

        .scroll-container {
            display: flex;
            overflow-x: hidden;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            scroll-behavior: smooth;
            flex-grow: 1;
        }

        .item {
            min-width: 150px;
            height: 200px;
            background-color: #ddd;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.2em;
            color: #333;
            flex-shrink: 0;
        }

        .item:last-child {
            margin-right: 0;
        }

        .scroll-button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5em;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .scroll-button.left {
            left: 10px;
        }

        .scroll-button.right {
            right: 10px;
        }

        .scroll-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
    <title>Horizontal Scrollable Items</title>
</head>

<body>
    <div class="container">
        <h2>Scrollable Items</h2>
        <div class="scroll-wrapper">
            <button class="scroll-button left" id="scrollLeft">&lt;</button>
            <div class="scroll-container" id="scrollContainer">
                <div class="item">Item 1</div>
                <div class="item">Item 2</div>
                <div class="item">Item 3</div>
                <div class="item">Item 4</div>
                <div class="item">Item 5</div>
                <div class="item">Item 6</div>
                <div class="item">Item 7</div>
                <div class="item">Item 8</div>
                <div class="item">Item 1</div>
                <div class="item">Item 2</div>
                <div class="item">Item 3</div>
                <div class="item">Item 4</div>
                <div class="item">Item 5</div>
                <div class="item">Item 6</div>
                <div class="item">Item 7</div>
                <div class="item">Item 8</div>
            </div>
            <button class="scroll-button right" id="scrollRight">&gt;</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.getElementById('scrollContainer');
            const scrollLeft = document.getElementById('scrollLeft');
            const scrollRight = document.getElementById('scrollRight');
            const items = Array.from(scrollContainer.children);

            // Clone items to create the infinite scroll effect
            items.forEach(item => {
                const clone = item.cloneNode(true);
                scrollContainer.appendChild(clone);
            });

            function scroll(step) {
                scrollContainer.scrollBy({
                    left: step,
                    behavior: 'smooth'
                });
            }

            scrollLeft.addEventListener('click', () => scroll(-150));
            scrollRight.addEventListener('click', () => scroll(150));

            function autoScroll() {
                if (scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth / 2) {
                    scrollContainer.scrollTo({
                        left: 0
                    });
                }
                scroll(150);
            }

            setInterval(autoScroll, 3000);

            // Optional: update scroll buttons based on position
            function updateScrollButtons() {
                scrollLeft.disabled = false;
                scrollRight.disabled = false;
            }

            updateScrollButtons();
            scrollContainer.addEventListener('scroll', updateScrollButtons);
        });
    </script>
</body>

</html>