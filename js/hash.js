function log( n , b ) {
	return Math.log( n ) / Math.log( b );
}
function hash( s ) {
	if ( s.length == 0 ) return hash("Placeholder Value");
	if ( s.length == 1 ) return String.fromCharCode( s.charCodeAt( 0 ) ^ 255 );
	var p = []
	var o = ""
	for ( var i = 0 ; i < s.length ; i++ ) {
		var cai = s.charCodeAt( i );
		var can = s.charCodeAt( ( i + 1 ) % s.length );
		p.push( cai >> 8 << 8 == cai ? cai >> 8 << ( can % 8 ) : i % 2 == 0 ? cai << ( can % 8 ) : cai >> 4 ^ can << 4 );
	}
	for ( var i = 0 ; i < s.length / 2 ; i++ ) {
		var j = i * 2;
		var r = ( p[ j ] ^ p[ j + 1 ] ) << i % 32
		while ( r >> 2 << 2 == r ) r = r >> 2;
		o += String.fromCharCode( r );
	}
	return hash( o );
}
function hashdigest( h ) {
	var d = h.charCodeAt( 0 );
	return d % 2 == 0 ? ( d ^ 127 ) % 256 : d % 256;
}
function tellUser( s ) {
	alert( s );
}
