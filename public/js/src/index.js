// import 'bootstrap/dist/css/bootstrap.css';
// import 'bootstrap/dist/js/bootstrap.js';
// import '../../libs/awesome/src.js';
import '../../less/style.less';
import '../app.js';
import '../../css/app.min.css';
import '../../fonts/fonts.css';

import SearchField from "./modules/SearchField.js";
import LoadMore from "./modules/Catalog/LoadMore";
import Products from "./modules/Catalog/Products";
import Filters from "./modules/Catalog/Filters";
import Basket from "./modules/WC/Basket";
import Order from "./modules/WC/Order";
import Cities from "./modules/Cities";
import Forms from "./modules/Forms";



// import TabController from "./modules/TabsController";
// import CarouselWrapper from "./modules/carouselWrapper";
// import NumberDivision from "./modules/NumberDivision";
// import Forms from "./modules/Forms";
// import SwitchingTheClass from "./Controllers/SwitchingTheClass";
// import WrapperMap from "./modules/WrapperMap";
// import FancyBoxWrapper from "./modules/FancyBoxWrapper";
//
// import { Config } from "./settings";
// import HeightBlocksInGrid from "./modules/HeightBlocksInGrid";
// import AddHandlerForEvent from "./Controllers/AddHandlerForEvent";
// import FilterItems from "./modules/FilterItems";
// const settings = Config;
//
document.addEventListener('DOMContentLoaded',
    function()
    {

        new SearchField();

        let ProductClass = new Products();

        new LoadMore(ProductClass);

        new Filters(ProductClass);

        new Basket();

        new Order();

        new Cities();

        new Forms();

        // settings.tabs.forEach(item=>{
        //     new TabController(item.selector);
        // });
        //
        // new CarouselWrapper();
        //
        // new NumberDivision();
        //
        // new Forms();
        //
        // new SwitchingTheClass('.navigation_wrapper .switch_btn','.navigation_wrapper');
        //
        // new FilterItems();
        //
        // new WrapperMap();
        //
        // new HeightBlocksInGrid();
        //
        // new FancyBoxWrapper();
        //
        // new AddHandlerForEvent(document.querySelector('.menu-item-has-children>a'),'click',(e)=>{e.preventDefault();});
        //
        //
        //
        // if(document.clientWidth < 768) //---------------------[ Мобильное суб меню ]
        // {
        //     new SwitchingTheClass('.menu-item-has-children','.menu-item-has-children .sub-menu');
        // }
        //
        //
        // ((elements)=>{//---------------------[ Отключение ссылки при нажатие на кнопку переключения карусели ]
        //     elements.forEach(element=>{
        //         element.onclick = (e)=>
        //         {
        //
        //             e = e || event;
        //             const target = e.target || e.srcElement;
        //             if(target.classList.contains('owl-prev')  || target.classList.contains('owl-next'))
        //             {
        //                 e.preventDefault();
        //             }
        //         };
        //     });
        // })(document.querySelectorAll('.card-furniture'));
        //
        //
        // (btns=>//---------------------[ Автоматическое вопроизведение видео с ютуб при нажатии на кнопку ]
        // {
        //     btns.forEach(btn=>
        //     {
        //         new AddHandlerForEvent(btn,'click',(e)=>
        //         {
        //             console.log(e.target);
        //             const video = document.querySelector(`${e.target.getAttribute('data-target')} iframe`);
        //             const src = video.getAttribute('src');
        //
        //
        //             video.setAttribute('src', src + '&autoplay=1');
        //         });
        //     });
        // })(document.querySelectorAll('.btn--video'));
        //
        //
        // (links=>//---------------------[ Ссылки с раскрывающимися блоками ]
        // {
        //     if(links.length < 0)
        //     {
        //         return;
        //     }
        //     links.forEach(link=>
        //     {
        //         new SwitchingTheClass(link,document.querySelector(link.getAttribute('href')));
        //         new SwitchingTheClass(link,link);
        //     });
        // })(document.querySelectorAll('.toggle_link a'));
        //
        // (btns=>//---------------------[ Вызов модального окна ]
        // {
        //     btns.forEach(btn=>
        //     {
        //         new AddHandlerForEvent(btn,'click',e=>
        //         {
        //             e.preventDefault();
        //             const title = btn.getAttribute('data-title');
        //             if(!title)
        //             {
        //                 return;
        //             }
        //
        //             document.querySelector(`${btn.getAttribute('data-target')} .h4`).innerHTML = title;
        //             document.querySelector(`${btn.getAttribute('data-target')} input[type="hidden"]`).value = `${title}`;
        //         });
        //     });
        //
        // })(document.querySelectorAll('.btn--callback'));
    });

