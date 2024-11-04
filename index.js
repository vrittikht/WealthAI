const left = document.querySelector('.arrow_left');
const right = document.querySelector('.arrow_right');
const slider = document.querySelector('.slider');
const img = document.querySelectorAll('.img');
const length = img.length;

let sildeNum = 1;

right.addEventListener('click',()=>{
    if(sildeNum < length) {
        slider.style.transform = `translateX(-${sildeNum*800}px)`;
        sildeNum++;
    }
    else{
        slider.style.transform = `translateX(0px)`;
        sildeNum = 1;
    }
});

left.addEventListener('click',()=>{
    if(sildeNum > 1) {
        slider.style.transform = `translateX(-${(sildeNum-2)*800}px)`;
        sildeNum--;
    }
    else{
        slider.style.transform = `translateX(-${(length-1)*800}px)`;
        sildeNum = length;
    }
});