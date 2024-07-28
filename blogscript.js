document.addEventListener("DOMContentLoaded", function() {
  const blogPosts = [
    {
      title: "Blog Post 1",
      summary: "This is a summary of blog post 1. It provides an overview of the content.",
      link: "#",
      image: "path/to/image1.jpg"
    },
    {
      title: "Blog Post 2",
      summary: "This is a summary of blog post 2. It provides an overview of the content.",
      link: "#",
      image: "path/to/image2.jpg"
    },
    {
      title: "Blog Post 3",
      summary: "This is a summary of blog post 3. It provides an overview of the content.",
      link: "#",
      image: "path/to/image3.jpg"
    }
  ];

  const blogContainer = document.getElementById('blogPosts');

  blogPosts.forEach(post => {
    const blogItem = document.createElement('div');
    blogItem.className = 'col-lg-4 col-md-6 blog-item';
    
    const blogContent = `
      <div class="card">
        <img src="${post.image}" class="card-img-top" alt="${post.title}">
        <div class="card-body">
          <h3 class="card-title">${post.title}</h3>
          <p class="card-text">${post.summary}</p>
          <a href="${post.link}" class="card-link">Read More</a>
        </div>
      </div>
    `;

    blogItem.innerHTML = blogContent;
    blogContainer.appendChild(blogItem);
  });
});