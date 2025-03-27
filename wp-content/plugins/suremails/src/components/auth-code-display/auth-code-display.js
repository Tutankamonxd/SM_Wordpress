import { useLayoutEffect } from '@wordpress/element';
import { useNavigate } from 'react-router-dom';
import { removeQueryArgs } from '@wordpress/url';

const AuthCodeDisplay = () => {
	const navigate = useNavigate();

	useLayoutEffect( () => {
		const storedFormStateTimeStamp = localStorage.getItem(
			'formStateValuesTimestamp'
		);

		if ( ! storedFormStateTimeStamp ) {
			return;
		}

		const currentTime = Date.now();
		if ( currentTime > storedFormStateTimeStamp ) {
			return;
		}

		const urlParams = new URLSearchParams( window.location.search );
		const code = urlParams.get( 'code' );

		if ( code ) {
			const storedFormState =
				JSON.parse( localStorage.getItem( 'formStateValues' ) ) || {};

			const paramsToRemove = [ 'code', 'scope' ];
			const cleanedUrl = removeQueryArgs(
				window.location.href,
				...paramsToRemove
			);
			window.history.replaceState( {}, '', cleanedUrl + '#/dashboard' );

			const updatedFormState = {
				...storedFormState,
				auth_code: code,
				type: 'GMAIL',
				refresh_token: '',
				force_save: true,
			};

			localStorage.setItem(
				'formStateValues',
				JSON.stringify( updatedFormState )
			);

			// Navigate to the connections page
			setTimeout( () => {
				navigate( '/connections', {
					state: {
						openDrawer: true,
						selectedProvider: 'GMAIL',
					},
				} );
			}, 300 );
		}
	}, [ navigate ] );

	return null;
};

export default AuthCodeDisplay;
