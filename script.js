document.getElementById('searchInput').addEventListener('input', function() {
    var searchQuery = this.value.toLowerCase();
    var content = document.getElementById('content');
    var searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';

    if (searchQuery.length === 0) {
        searchResults.style.display = 'none';
        return;
    }

    content.querySelectorAll('h2').forEach(function(item) {
        var title = item.textContent.toLowerCase();
        if (title.includes(searchQuery)) {
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.href = '#' + item.id;
            a.textContent = item.textContent;
            li.appendChild(a);
            searchResults.appendChild(li);
        }
    });

    if (searchResults.children.length > 0) {
        searchResults.style.display = 'block';
    } else {
        searchResults.style.display = 'none';
    }
});

