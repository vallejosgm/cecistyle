const the_animation = document.querySelectorAll('.animated')

const observer = new IntersectionObserver(entries => {
	entries.forEach(entry => {
		if(entry.isIntersecting){
			entry.target.classList.remove('animated')
			entry.target.classList.add('fade-in-image')
		} else {
			entry.target.classList.remove('fade-in-image')
			entry.target.classList.add('animated')
		}
		})
	}, 
	{ threshold: 0.5
   }
	);

for (let i = 0; i < the_animation.length; i++) {
   const elements = the_animation[i];
    observer.observe(elements);
  } 