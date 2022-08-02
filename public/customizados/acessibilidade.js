
  const env = {}
env.HOST = 'http://127.0.0.1/help/public/';
env.BASE_DIR = '/';
env.URL = env.HOST + env.BASE_DIR;
env.URL_TMP = 'http://127.0.0.1/help/public/';
env.URL_API = env.URL_TMP + 'api/';

env.FONT_SIZES = Array('xsmall', 'small', 'medium', 'large', 'xlarge');

  const fetchData = async uri => {
  const response = await fetch(env.URL_API + uri);
  const data = await response.json();
  return data;
}

const formatMoney = (amount, decimalCount = 2, decimal = ",", thousands = ".") => {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substring(0, j) + thousands : '') + i.substring(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

const slugify = (text, separator = "-") => {
  return text
      .toString()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .toLowerCase()
      .trim()
      .replace(/[^a-z0-9 ]/g, '')
      .replace(/\s+/g, separator);
};

const scrollTo = (elDest, paddingTop = 0) => {
  const diffTop = elDest.offsetTop - paddingTop;
  const offsetTop = diffTop < 0 ? 0 : diffTop;

  scroll({
    top: offsetTop,
    behavior: "smooth"
  });
}

const getSessionNumber = (name, def = 0) =>{
  let number = sessionStorage.getItem(name) || def;
  return parseInt(number);
}

document.addEventListener('DOMContentLoaded', () => {
  const dvShow = document.querySelectorAll('.mostra');
  const increase = document.getElementById('increase-font');
  const decrease = document.getElementById('decrease-font');
  const normal = document.getElementById('normal-font');
  const colors = document.getElementById('change-colors');
  const rootCss = document.querySelector(':root');
  const html = document.querySelector('html');

  let number = getSessionNumber('font-size', 2);
  html.classList.add(env.FONT_SIZES[number]);

  let numColors = getSessionNumber('change-colors', 0);
  if(numColors == 1){
    rootCss.style.setProperty('--black', '#F3F3F3');
    rootCss.style.setProperty('--white', '#202020');
    rootCss.style.setProperty('--gray-lightest', '#3F3F3F');
    rootCss.style.setProperty('--gray-light', '#888888');
    rootCss.style.setProperty('--gray-dark', '#C4C4C4');
    rootCss.style.setProperty('--gray-darkest', '#F3F3F3');
  }

  dvShow.forEach(el => {
    el.addEventListener('click', (e) => {
      const id = e.target.id.replace(/[^0-9]/g, '');
      const oculto = document.getElementById('oculto-' + id);
      oculto.classList.toggle('oculto-in');

      scrollTo(oculto, 42);
    });
  });
  colors.addEventListener('click', () => {
    let number = getSessionNumber('change-colors');
    number = 1 - number;
    if(number == 1){
      rootCss.style.setProperty('--black', '#F3F3F3');
      rootCss.style.setProperty('--white', '#202020');
      rootCss.style.setProperty('--gray-lightest', '#3F3F3F');
      rootCss.style.setProperty('--gray-light', '#888888');
      rootCss.style.setProperty('--gray-dark', '#C4C4C4');
      rootCss.style.setProperty('--gray-darkest', '#F3F3F3');
    }else{
      rootCss.style.setProperty('--black', '#202020');
      rootCss.style.setProperty('--white', '#FFFFFF');
      rootCss.style.setProperty('--gray-lightest', '#F3F3F3');
      rootCss.style.setProperty('--gray-light', '#C4C4C4');
      rootCss.style.setProperty('--gray-dark', '#888888');
      rootCss.style.setProperty('--gray-darkest', '#3f3f3f');
    }
    sessionStorage.setItem('change-colors', number);

  });
  increase.addEventListener('click', () => {
    let number = getSessionNumber('font-size', 2);
    html.classList.remove(env.FONT_SIZES[number]);

    number = Math.min(4, number + 1);
    
    html.classList.add(env.FONT_SIZES[number]);
    sessionStorage.setItem('font-size', number);
  });
  decrease.addEventListener('click', () => {
    let number = getSessionNumber('font-size', 2);
    html.classList.remove(env.FONT_SIZES[number]);

    number = Math.max(0, number - 1);

    html.classList.add(env.FONT_SIZES[number]);
    sessionStorage.setItem('font-size', number);
  });
  normal.addEventListener('click', () => {
    let number = getSessionNumber('font-size', 2);
    html.classList.remove(env.FONT_SIZES[number]);

    sessionStorage.setItem('font-size', 2);
  });
});


