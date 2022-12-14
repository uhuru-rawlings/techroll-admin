document.getElementById("blog_title").addEventListener("change", () => {
    var target = document.getElementById("blog_title").value.trim();
    document.getElementById("blog_slug").value = target.replaceAll(" ",'-').toLowerCase();
});