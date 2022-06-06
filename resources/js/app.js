import 'bootstrap';

const currentUrl = window.location.href.split('?')[0];
const paginatedList = document.getElementById('paginatedList');

if (paginatedList) {
    let search = '';
    let filter = {};

    paginatedList.addEventListener('click', (e) => {
        let target = e.target;
        if (target.className === 'page-link' && target.nodeName === 'A') {
            e.preventDefault();
            let url = target.href;
            getData(url);
        }
    });

    if (document.getElementById('search')) {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const clearSearchButton = document.getElementById('clearSearchButton');
    
        clearSearchButton.addEventListener('click', removeSearch);
        searchButton.addEventListener('click', applySearch);
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                applySearch();
            }
            if (e.key === 'Escape') {
                removeSearch();
            }
        });
    
        function applySearch() {
            search = searchInput.value;
            if (search) {
                show(clearSearchButton);
                getData(currentUrl);
            }
        }
    
        function removeSearch() {
            search = '';
            searchInput.value = '';
            hide(clearSearchButton);
            getData(currentUrl);
        }
    }

    const statusFilter = document.getElementById('status-filter');
    if (statusFilter) {
        statusFilter.addEventListener('change', (e) => {
            let selectedOption = statusFilter.options[statusFilter.selectedIndex];
            selectedOption.selected = 'selected';
            switch (selectedOption.value) {
                case 'untested':
                    filter.testCaseStatus = 'untested';
                    break;
                case 'passed':
                    filter.testCaseStatus = 'passed';
                    break;
                case 'failed':
                    filter.testCaseStatus = 'failed';
                    break;
                default:
                    if (filter.testCaseStatus) delete filter.testCaseStatus
                    break;
            }
            getData(currentUrl);
        });
    }
    
    async function getData(url) {
        if (search) {
            if (url.includes('?')) {
                url += '&search=' + search;
            } else {
                url += '?search=' + search;
            }
        }

        if (Object.keys(filter).length !== 0) {
            if (url.includes('?')) {
                url += '&filter=' + JSON.stringify(filter);
            } else {
                url += '?filter=' + JSON.stringify(filter);
            } 
        }
    
        const resp = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
    
        if (resp.ok) {
            paginatedList.innerHTML = await resp.text();
        }
    }
}

const testCases = document.getElementById('casesList');
if (testCases) {
    document.getElementById('all').addEventListener('click', () => hide(testCases));
    document.getElementById('selected').addEventListener('click', () => show(testCases));
}

function show(element) {
    element.classList.remove("d-none");
}
function hide(element) {
    element.classList.add("d-none");
}
