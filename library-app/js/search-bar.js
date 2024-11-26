// search-bar

const inputSearch = document.querySelector('.search-bar');
const btnSearch = document.querySelector('.search-btn');
const selectSearch = document.querySelector('.search-slct');

const mainWin = window.location.href.split('?')[0];

inputSearch.addEventListener('keypress', e => {
  if (e.key === '/') {
    e.preventDefault();
  }
  if (e.code === 'Enter') {
    searchData();
  }
  if (selectSearch) {
    if ((isNaN(e.key) || e.code === 'Space') && selectSearch.value == 0) {
      e.preventDefault();
    }
  }
});

btnSearch.addEventListener('click', function () {
  searchData();
});

function searchData() {
  if (inputSearch.value) {
    if (selectSearch) {
      window.location =
        mainWin + `?search=${inputSearch.value}/${selectSearch.value}`;
    } else {
      window.location = mainWin + `?search=${inputSearch.value}`;
    }
    console.log(window);
  } else {
    window.location = mainWin;
  }
}
