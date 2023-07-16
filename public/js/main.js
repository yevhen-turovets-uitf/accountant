(function() {
    // бургер меню
    const burger = document.querySelector('.burger')
    const sidebar = document.querySelector('.sidebar')
    burger.onclick = function() {
        burger.classList.toggle("active");
        sidebar.classList.toggle("active");
    }

    if (document.querySelectorAll(".select").length) {
        var els = document.querySelectorAll(".select");
        els.forEach(function(select) {
            NiceSelect.bind(select);
        });
    }

    // контакты

    // валидация формы
    // пример валидации формы с id contact-form
    if (document.getElementById("contact-form")) {
        let form = document.getElementById("contact-form");

        let pristine = new Pristine(form);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var valid = pristine.validate();
            if (valid) {
                fadeOut(form)
                fadeIn(document.getElementById('contact-form-susses'), 'block')
            }
        });
    }

    //востановить пароль
    if (document.getElementById("forgot")) {
        let form = document.getElementById("forgot");

        let pristine = new Pristine(form);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let valid = pristine.validate();
        });
    }

    // help
    let helpItems = document.querySelectorAll('.help__right__item')
    let helpContent = document.querySelectorAll('.help__content')
    for (let i = 0; i < helpItems.length; i++) {
        helpItems[i].setAttribute('data-index', i);
    }

    // слушает клик
    for (let helpItem of helpItems) {
        helpItem.addEventListener('click', (e) => {
            helpContent[helpItem.getAttribute('data-index')].classList.add('active')

            // прокрутка к контенту на моб
            if (window.innerWidth < 768) {
                let contentOffsetTop = helpContent[helpItem.getAttribute('data-index')].offsetTop
                window.scrollTo({
                    top: contentOffsetTop - 50,
                    behavior: "smooth"
                })
            }
        })
    }

    // normbasa-d
    let otchetTreeItems = document.querySelectorAll('.itemfor')
    let otchetItems = document.querySelectorAll('.otchet__item')
    for (let otchetTreeItem of otchetTreeItems) {
        otchetTreeItem.addEventListener('click', function() {
            [].forEach.call(otchetTreeItems, function(el) {
                el.classList.remove('active')
            });
            [].forEach.call(otchetItems, function(el) {
                el.classList.remove('active')
            });

            otchetTreeItem.classList.add('active')
            otchetItems[otchetTreeItem.getAttribute('data-for')].classList.add('active')

        })
    }

    // otchet__tree2
    let treeLevel = document.querySelectorAll('.tree__item__wrap')
    for (el of treeLevel) {
        el.addEventListener('click', function() {
            let parent = this.closest('.tree__item')
            if (parent.classList.contains('active')) {
                parent.classList.remove('active')
            } else {
                otherParent = parent.closest('ul').querySelectorAll('.tree__item');
                [].forEach.call(otherParent, function(el) {
                    el.classList.remove('active')
                })
                parent.classList.add('active')
            }
        })
    }

    let treeFors = document.querySelectorAll('.tree__for')
    for (treeFor of treeFors) {
        treeFor.addEventListener('click', function() {
            [].forEach.call(otchetItems, function(el) {
                el.classList.remove('active')
            })
            otchetItems[this.getAttribute('data-for')].classList.add('active')
        })
    }

    // Активный элемент в дереве разделов
    const elementsTree = document.querySelectorAll('.element__for');
    elementsTree.forEach(element => {
        element.addEventListener('click', () => {
            elementsTree.forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        });
    });

    if(document.querySelector('.glide')){
        new Glide('.glide',{
            type: 'carousel',
            startAt: 0,
            perView: 1
        }).mount()
    }

    if(document.querySelector('.calendar__slider')){
        new Glide('.calendar__slider',{
            type: 'slider',
            startAt: 0,
            perView: 10,
            dragThreshold: false,
            rewind: true,
            breakpoints: {
                1350: {
                    perView: 8
                },
                1199: {
                    perView: 12
                },
                767: {
                    perView: 7
                },
                424: {
                    perView: 6
                }
            }

        }).mount()
    }

    // filter-thead
    let filtertheads = document.querySelectorAll('.filter-thead')
    filtertheads.forEach(el => el.addEventListener('click', function(){
        el.classList.toggle('active')
    }))

    if(document.getElementById('choose_otchet')){
        let choose_otchet = document.getElementById('choose_otchet')
        let choose_otchet__close = document.getElementById('choose_otchet__close')

        document.getElementById('open-otchet-list').addEventListener('click', ()=>{
            fadeIn(choose_otchet)
        })

        choose_otchet__close.addEventListener('click', ()=>{
            fadeOut(choose_otchet)
        })

        choose_otchet.addEventListener('click', (e)=>{
            if(!e.target.closest('.choose_otchet__wrap')){
                fadeOut(choose_otchet)
            }
        })
    }

    let izbItem = document.querySelectorAll('.remove-izb-item')
    izbItem.forEach(el => el.addEventListener('click', ()=>{
        el.closest('.izbranoe__item').classList.add('remove')
        setTimeout(()=>{
            el.closest('.izbranoe__item').remove()
        }, 300)
    }))

    // архив валют админ
    if(document.getElementById('arhiv-val-admin-calendar')){
        const elem = document.getElementById('arhiv-val-admin-calendar');
        const datepicker = new Datepicker(elem, {
            language: 'ru',
            format: 'dd.mm.yyyy'
        });
    }

    let categories = document.getElementById('categories')
    if(categories){
        let jstree_closed = document.querySelectorAll('.jstree-node i')
        jstree_closed.forEach(el => el.addEventListener('click', (e)=>{
            let closest = el.closest('.jstree-node')
            if(closest.classList.contains('jstree-closed')){
                closest.classList.remove('jstree-closed')
                closest.classList.add('jstree-open')
            }else{
                closest.classList.add('jstree-closed')
                closest.classList.remove('jstree-open')
            }


        }))
    }
})();

// пользовательские функции
function addVal() {
    let infoLabel = document.querySelector('#add-info')
    infoLabel.style.display = "block";
    infoLabel.classList.add('fadein')
    setTimeout(function() {
        infoLabel.classList.remove('fadein')
        setTimeout(function() {
            infoLabel.style.display = "none";
        }, 300)

    }, 2000)
}

function slideToggle(el, duration, callback) {
    if (el.clientHeight === 0) {
        _s(el, duration, callback, true);
    } else {
        _s(el, duration, callback);
    }
}

function slideUp(el, duration, callback) {
    _s(el, duration, callback);
}

function slideDown(el, duration, callback) {
    _s(el, duration, callback, true);
}

function _s(el, duration, callback, isDown) {

    if (typeof duration === 'undefined') duration = 400;
    if (typeof isDown === 'undefined') isDown = false;

    el.style.overflow = "hidden";
    if (isDown) el.style.display = "block";

    var elStyles = window.getComputedStyle(el);

    var elHeight = parseFloat(elStyles.getPropertyValue('height'));
    var elPaddingTop = parseFloat(elStyles.getPropertyValue('padding-top'));
    var elPaddingBottom = parseFloat(elStyles.getPropertyValue('padding-bottom'));
    var elMarginTop = parseFloat(elStyles.getPropertyValue('margin-top'));
    var elMarginBottom = parseFloat(elStyles.getPropertyValue('margin-bottom'));

    var stepHeight = elHeight / duration;
    var stepPaddingTop = elPaddingTop / duration;
    var stepPaddingBottom = elPaddingBottom / duration;
    var stepMarginTop = elMarginTop / duration;
    var stepMarginBottom = elMarginBottom / duration;

    var start;

    function step(timestamp) {

        if (start === undefined) start = timestamp;

        var elapsed = timestamp - start;

        if (isDown) {
            el.style.height = (stepHeight * elapsed) + "px";
            el.style.paddingTop = (stepPaddingTop * elapsed) + "px";
            el.style.paddingBottom = (stepPaddingBottom * elapsed) + "px";
            el.style.marginTop = (stepMarginTop * elapsed) + "px";
            el.style.marginBottom = (stepMarginBottom * elapsed) + "px";
        } else {
            el.style.height = elHeight - (stepHeight * elapsed) + "px";
            el.style.paddingTop = elPaddingTop - (stepPaddingTop * elapsed) + "px";
            el.style.paddingBottom = elPaddingBottom - (stepPaddingBottom * elapsed) + "px";
            el.style.marginTop = elMarginTop - (stepMarginTop * elapsed) + "px";
            el.style.marginBottom = elMarginBottom - (stepMarginBottom * elapsed) + "px";
        }

        if (elapsed >= duration) {
            el.style.height = "";
            el.style.paddingTop = "";
            el.style.paddingBottom = "";
            el.style.marginTop = "";
            el.style.marginBottom = "";
            el.style.overflow = "";
            if (!isDown) el.style.display = "none";
            if (typeof callback === 'function') callback();
        } else {
            window.requestAnimationFrame(step);
        }
    }

    window.requestAnimationFrame(step);
}


function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || 'block';
    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .1) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}

function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = 'none';
        } else {
            requestAnimationFrame(fade);
        }
    })();
}
