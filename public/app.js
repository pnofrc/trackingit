 // menu animation
 let toggle = true
 let corpus = document.querySelector('#corpus')
 let burgers = document.querySelectorAll('.clickMenu')

 let burger = document.querySelector('.burger')
 let titleBurger = document.querySelector('.burger span')

 let fake = document.querySelector('#fakeMenuBackground')
 let backMenu =document.querySelector('#backMenu')

 let textMenu = document.querySelector('.burger span')

//  burgers.forEach(burger => {
    burger.addEventListener('click', () => {
        if (toggle) {
            corpus.classList.add('animate__slideInLeft')
            corpus.classList.remove('.animate__slideOutLeft')
            document.body.style.setProperty('--backLight', '#F9FECE');
            burger.style.left = '-48%'
            
            textMenu.innerHTML = 'CHIUDI'
            textMenu.style.rotate = '39deg'
            textMenu.style.marginTop = '6rem'
            burger.style.gap = '0';

            toggle = !toggle
        } else{
           corpus.classList.remove('animate__slideInLeft')
           corpus.classList.add('animate__slideOutLeft')
           document.body.style.setProperty('--backLight', 'rgba(131, 132, 122, 0.7)');

           burger.style.left = '121%'

           setTimeout(() => {
                burger.style.left = '51%'
            }, 600);

            textMenu.innerHTML = 'MENU'
            textMenu.style.rotate = '0deg'
            textMenu.style.marginTop = 'unset'
            burger.style.gap = '1.5rem';

           toggle = !toggle
        }
    })


    burger.addEventListener('mouseover', () =>{
        if (toggle) {
            burger.style.opacity = '50%'
            burger.classList.add('animate__bounce')
        }
    })


    burger.addEventListener('mouseleave', () =>{
        burger.style.opacity = '100%'
        burger.classList.remove('animate__bounce')
    })

 fake.addEventListener('click', () => {
     if (!toggle) {
         corpus.classList.remove('animate__slideInLeft')
         corpus.classList.add('animate__slideOutLeft')
         document.body.style.setProperty('--backLight', 'rgba(131, 132, 122, 0.7)');

         burger.style.left = '121%'

         setTimeout(() => {
              burger.style.left = '51%'
          }, 600);

          textMenu.innerHTML = 'MENU'
          textMenu.style.rotate = '0deg'
          textMenu.style.marginTop = 'unset'
          burger.style.gap = '1.5rem';
          
         toggle = !toggle
     }
 })


 backMenu.addEventListener('click', () => {
    if (!toggle) {
        corpus.classList.remove('animate__slideInLeft')
        corpus.classList.add('animate__slideOutLeft')
        document.body.style.setProperty('--backLight', 'rgba(131, 132, 122, 0.7)');
        toggle = !toggle
    }
})


