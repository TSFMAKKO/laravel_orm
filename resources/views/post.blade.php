<!-- resources/views/posts/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Index</title>
    <style>
        * {
            /* height: 150vh; */
            /* margin: 0; */
            /* position: relative; */
            box-sizing: border-box;
        }

        .box {
            width: 50vw;
            height: 10vh;
            background-color: #3498db;
            margin: 20px;
            /* color: white; */
            text-align: center;
            /* line-height: 100px; */
            /* position: absolute; */
            bottom: 0;
            margin-top: 200px;
        }

        .aaa {
            height: 10vh;
        }

        .msg {
            width: 50vw;
        }

        .sub {
            padding-left: 40px;
        }

        p {
            /* margin: 0; */

        }

        .id_pic {
            border-radius: 50%;
            /* position: relative; */
            /* top: 50%; */
            transform: translateY(20px);

        }
    </style>
</head>

<body>
    <h1>Post</h1>

    <div>
        <p><img class="id_pic" src="https://picsum.photos/50/50?random={{ $post->user->id }}" alt=""> 作者:
            {{ $post->user->name }}</p>
        <p>標題: {{ $post->title }}</p>
        <p>內容: {{ $post->content }}</p>
    </div>
    <div>
        回應:
        @foreach ($comments as $comment)
            <div>
                {{-- {{ $comment->id }}. --}}
                <div>
                    <img class="id_pic" src="https://picsum.photos/50/50?random={{ $comment->user->id }}" alt="">
                    作者 {{ $comment->user->name }}
                </div>

                <p>{{ $comment->content }}</p>

                <span><a href="/reply/{{ $comment->id }}"
                        onclick="replyHandler(event,this)">查看其他{{ $comment->replies_count }}則留言 </a></span>

                <span>
                    <input type="text" name="" id="" placeholder="留言......." onkeyup="msgHandler($comment->id)" data-url="/reply/{{$comment->id}}"></span>
                    {{-- <a href="#" onclick="msgHandler()">留言</a> --}}
            </div>
        @endforeach
    </div>

    <div class="aaa box"></div>

    <div id="comment" class="lazy">
        回應2

    </div>
    <div class="box"></div>

    <script>
        console.log(comment);

        async function replyHandler(e) {
            e.preventDefault();
            console.log(e.target.href);
            let target = e.target;
            target.innerHTML = '載入中...'
            // fetch(e.target.href).then(res => res.json()).then(data => {
            //     console.log(data);
            //     let span = e.target.closest('span');
            //     let div = e.target.closest('div');



            //     data.forEach(el => {
            //         // div.innerHTML += `<p> ${el["content"]}<p>`;
            //         let pElement = document.createElement('p');
            //         pElement.classList.add("sub")
            //         pElement.textContent = el.content;
            //         div.insertBefore(pElement, span); // 插入在 "載入回應" 之前


            //     });

            //     console.log(span);
            //     span.remove();
            // })

            let req = fetch(e.target.href);
            target.innerHTML = '載入中2...'

            const responses = await req;
            let data = await responses.json();


            // const response = await Promise.race([request1, request2]);
            // const response = await Promise.all([request1, request2]);
            // const data = await response.json();
            console.log(data);
            console.log(target);

            let span = e.target.closest('span');
            let div = e.target.closest('div');



            data.forEach(el => {
                // div.innerHTML += `<p> ${el["content"]}<p>`;
                let pElement = document.createElement('p');
                pElement.classList.add("sub");

                let imgElement = document.createElement('img');
                imgElement.classList.add("id_pic");
                imgElement.src = `https://picsum.photos/50/50?random=${el.user.id}`;

                pElement.textContent = ` 作者 ${el.user.name}`;

                // Insert the imgElement at the beginning of the pElement
                pElement.insertBefore(imgElement, pElement.firstChild);

                div.insertBefore(pElement, span); // Insert the pElement before the "載入回應" element

                // 內容的p
                pElement = document.createElement('p');
                pElement.classList.add("sub");
                pElement.textContent = ` ${el.content}`;

                div.insertBefore(pElement, span);


            });

            console.log(span);
            span.remove();


        }
        let page = 1;

        // 定義觀察者回調函數
        function handleIntersection(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // 元素進入可視區域
                    entry.target.style.backgroundColor = 'green';
                    // 載入
                    loading(page);
                    page += 1;
                } else {
                    // 元素離開可視區域
                    entry.target.style.backgroundColor = 'blue';
                }
            });
        }

        // 創建 IntersectionObserver 實例，指定觀察者回調函數
        const observer = new IntersectionObserver(handleIntersection, {
            threshold: 0.9
        });

        // 取得要觀察的元素
        const boxes = document.querySelectorAll('.box');

        // 將元素添加到觀察者中
        boxes.forEach(box => {
            observer.observe(box);
        });

        async function loading(page) {
            url = `/comment/{{ $post->id }}?page${page}`;
            console.log(url);

            let res = await fetch(url);
            let data = await res.json();

            console.log(data);
            let html = "";
            data.forEach(el => {
                html += `
                        <div class="msg">
                        <p><img class="id_pic" src="https://picsum.photos/50/50?random=${el.user.id}"> 作者 ${el.user.name}</p> 
                            <p>${el.content}</p>
                            <span><a href='/reply/${el.id}' onclick="replyHandler(event,this)">查看其他${el.replies_count}則留言</a></span>
                        </div>
                    `;


            })
            // html += `<a href='/comment/{{ $post->id }}?page=2'>繼續載入</a>`;

            comment.innerHTML += html;
        }


        // init();


        // 當滾動到特定位置時再載入內容
        // let flag = false;

        // function lazyLoad(page = null) {
        //     var lazys = document.querySelectorAll(".lazy");
        //     lazys.forEach(lazy => {
        //         var rect = lazy.getBoundingClientRect();
        //         if (rect.top < window.innerHeight && rect.bottom >= 0) {
        //             console.log("lazyLoad");
        //             // if (!flag) {
        //             //     setTimeout(() => {
        //             //         init(page);
        //             //         flag=true
        //             //     }, 500)
        //             // } else {
        //             //     // inin2(page)
        //             // }

        //             setTimeout(() => {
        //                 init(page);

        //             }, 1000)

        //             // 加載後，移除滾動監聽器
        //             window.removeEventListener("scroll", lazyLoad);
        //         }
        //     })


        // }



        // document.addEventListener("DOMContentLoaded", function() {
        //     // 在頁面加載時添加滾動監聽器
        //     window.addEventListener("scroll", lazyLoad);

        //     // 初始檢查是否需要立即加載（如果 div 在可視區域內）
        //     lazyLoad();
        // });
    </script>
</body>

</html>
