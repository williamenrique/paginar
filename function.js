let nombre = ''
scanBotones()
const form =  document.querySelector('header form')
form.addEventListener('submit', (e) => {
	nombre = form.querySelector('input[type=search]').value
	num = 1
	// const anterior = document.querySelector('.actual')
	// if(anterior) anterior.classList.remove('actual')
	// document.querySelector('#paginador li:first-child a').classList.add('actual')
	buscar(nombre, num)
	e.preventDefault()
}) 


function scanBotones(){
	const botones = document.querySelectorAll('#paginador a')
	for (var i = 0; i < botones.length; i++) {
		botones[i].addEventListener('click',(e) => {
			// const anterior = document.querySelector('.actual')
			// if(anterior) anterior.classList.remove('actual')
				// e.target.classList.add('actual')
			const num = e.target.dataset.pagina
			buscar(nombre, num)
			e.preventDefault()

		})
	}
}

function buscar (que, num){
	const formdata = new FormData()
	formdata.append('nombre', que)
	formdata.append('numero', num)

	fetch('ajax-buscar.php', {method: 'post',body : formdata})
	.then(function(j){return j.json()})
	.then(function(data){
		const paginador = document.querySelector('#paginador')
		const publicaciones = document.querySelector('#publicaciones')
		// TODO: resetea el listado de resultados
		publicaciones.innerHTML = ''
		data.resultados.forEach(u =>{
		 publicaciones.innerHTML += `
         <li>
		    <h3>${u.sitio}</h3>
			<p>${u.url}</p>
		</li>
		 `

		})
		// resetear la botonera del paginador
		paginador.innerHTML = ''
		for (var i = 1; i <= data.paginas; i++) {
			let actual = data.actual == i ? "class='actual' " : " "
			paginador.innerHTML += `
				<li><a href='' ${actual} data-pagina='${i}'>${i}</a></li>
			 `
		}
		scanBotones() 
	})
}