/* =========================================
   WONDERLIFE – FORUM RENDER
========================================= */

document.addEventListener("DOMContentLoaded", () => {
  const list = document.querySelector(".forum-list");
  if (!list || !window.WLN_FORUM) return;

  list.innerHTML = "";

  WLN_FORUM.categories.forEach(item => {
    const li = document.createElement("li");

    const title = document.createElement("span");
    title.textContent = item.name;

    const count = document.createElement("span");
    count.textContent = item.posts;

    li.appendChild(title);
    li.appendChild(count);
    list.appendChild(li);
  });
});
