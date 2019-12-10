/**
 * Author: Jose J. Pardines
 * Date: 2019-12-09
 *
 * Accordion class
 */

class Accordion {
	constructor( options = null ) {
		if ( options ) {
			this.options = options;
		}
		this.init();
	}

	/**
	 * @author Jose J. Pardines
	 *
	 * Accordion's options for create it
	 *
	 * @type {{}}
	 * @private
	 */
	_options = null;

	/**@author Jose J. Pardines
	 *
	 * Get the accordion's options
	 *
	 * @returns {{}}
	 */
	get options() { return this._options; }

	/**
	 * @author Jose J. Pardines
	 *
	 * Set the new params for the accordion
	 *
	 * @param options Params to create an accordion
	 */
	set options( options ) { this._options = options; }

	/**
	 * @author Jose J. Pardines
	 *
	 * Creates a Panel element with its childs
	 *
	 * @param item This contains the options for this panel (Required)
	 * @returns {HTMLElement} Return a div element created with param's options
	 * @private
	 */
	_createPanel = ( item ) => {
		const panel = this._createElement( 'div', 'panel' );
		const containerInfo = this._createElement( 'div', 'row' );
		const containerDesc = this._createElement( 'div', 'row' );
		const materialIcon = this._createElement( 'i', 'material-icons', 'keyboard_arrow_down' );
		containerInfo.appendChild( this._createElement( 'div', 'item-title col xs-10 sm-10 md-10 xl-10', item.title ) );
		containerInfo.appendChild( this._createElement( 'div', 'item-icon col xs-2 sm-2 md-2 xl-2 align-flex-end', null, materialIcon.outerHTML ) );
		if(item.subtitle) {
			containerInfo.appendChild( this._createElement( 'div', 'item-subtitle col xs-12 sm-12 md-12 xl-12', item.subtitle ) );
		}
		containerDesc.appendChild( this._createElement( 'div', 'item-desc col xs-12 sm-12 md-12 xl-12', null, item.content ) );
		panel.appendChild( containerInfo );
		panel.appendChild( containerDesc );
		return panel;
	};

	/**
	 * @author Jose J. Pardines
	 *
	 * Creates a element passed as a tagName param with the param's options
	 *
	 * @param tagName Is the element type (div, p, button...) (Required)
	 * @param className Is the class by default for this new element (Required)
	 * @param text Is the text inside this new element (Optional)
	 * @param html Is the HTML inside this new element (Optional)
	 * @returns {HTMLElement} Returns a new element with all options
	 * @private
	 */
	_createElement = ( tagName, className, text = null, html = null ) => {
		const element = document.createElement( tagName );
		element.setAttribute( 'class', className );
		if ( text ) {
			element.innerText = text;
		}
		if ( html ) {
			element.innerHTML = html;
		}
		return element;
	};

	/**
	 * @author Jose J. Pardines
	 *
	 * Check if a text is empty
	 *
	 * @param text Is the text to be checked (Required)
	 * @returns {boolean} Return true if is empty or false if not
	 * @private
	 */
	_isEmpty = ( text = '' ) => {
		return !text || text.trim() === '';
	};

	/**
	 * @author Jose J. Pardines
	 *
	 * Adds a click event listener to each panel generate
	 * to do slide toggle
	 *
	 * @private
	 */
	_addEventListener = () => {
		const panels = document.getElementsByClassName( 'panel' );
		const accordion = document.getElementsByClassName( 'accordion' )[ 0 ];
		if ( panels && panels.length > 0 ) {
			for ( let panel of panels ) {
				panel.addEventListener( 'click', () => {
					panel.classList.toggle( 'open' );
					panel.classList.toggle( 'box-shadow' );
					accordion.classList.toggle( 'box-shadow' );
					const desc = panel.getElementsByClassName( 'item-desc' )[ 0 ];
					const arrow = panel.getElementsByClassName( 'material-icons' )[ 0 ];
					desc.classList.toggle( 'pt-25' );
					desc.classList.toggle( 'pb-25' );
					if ( desc.style.maxHeight ) {
						desc.style.maxHeight = null;
						arrow.innerText = 'keyboard_arrow_down';
					} else {
						desc.style.maxHeight = desc.scrollHeight + 'px';
						arrow.innerText = 'keyboard_arrow_up';
					}
				} );
			}
		}
	};

	/**
	 * @author Jose J. Pardines
	 *
	 * Init the accordion, creating panels and adding click listeners
	 */
	init() {
		const accordion = this._createElement( 'div', 'accordion box-shadow' );

		if ( this.options ) {
			if ( !this._isEmpty( this.options.mainTitle ) ) {
				const mainTitle = this._createElement( 'div', 'col xs-12 sm-12 md-12 xl-12', this.options.mainTitle );
				accordion.appendChild( this._createElement( 'div', 'row main-title', null, mainTitle.outerHTML ) );
			}

			for ( let panel of this.options.panels ) {
				accordion.appendChild( this._createPanel( panel ) );
			}

			document.getElementById( this.options.container ).appendChild( accordion );
		}
		this._addEventListener();
	}
}
