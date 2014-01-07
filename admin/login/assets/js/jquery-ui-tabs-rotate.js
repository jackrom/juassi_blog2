bplist00�_WebMainResource�	
_WebResourceMIMEType_WebResourceTextEncodingName_WebResourceFrameName^WebResourceURL_WebResourceData_application/x-javascriptUUTF-8P_�http://theme.crumina.net/onetouch/wp-content/plugins/js_composer/assets/jquery-ui-tabs-rotate/jquery-ui-tabs-rotate.js?ver=3.4.12Oe<html><head></head><body><pre style="word-wrap: break-word; white-space: pre-wrap;">;(function($){
	$.extend( $.ui.tabs.prototype, {
		rotation: null,
		rotationDelay: null,
		continuing: null,
		rotate: function( ms, continuing ) {
			var self = this,
				o = this.options;

			if((ms &gt; 1 || self.rotationDelay === null) &amp;&amp; ms !== undefined){//only set rotationDelay if this is the first time through or if not immediately moving on from an unpause
				self.rotationDelay = ms;
			}

			if(continuing !== undefined){
				self.continuing = continuing;
			}

			var rotate = self._rotate || ( self._rotate = function( e ) {
				clearTimeout( self.rotation );
				self.rotation = setTimeout(function() {
					var t = o.active;
					self.option( "active",  ++t &lt; self.anchors.length ? t : 0 );
				}, ms );

				if ( e ) {
					e.stopPropagation();
				}
			});

			var stop = self._unrotate || ( self._unrotate = !continuing
				? function(e) {
					if (e.clientX) { // in case of a true click
						self.rotate(null);
					}
				}
				: function( e ) {
					t = o.active;
					rotate();
				});

			// start rotation
			if ( ms ) {
				this.element.bind( "tabsshow", rotate );
				this.anchors.bind( o.event + ".tabs", stop );
				rotate();
			// stop rotation
			} else {
				clearTimeout( self.rotation );
				this.element.unbind( "tabsshow", rotate );
				this.anchors.unbind( o.event + ".tabs", stop );
				delete this._rotate;
				delete this._unrotate;
			}

			//rotate immediately and then have normal rotation delay
			if(ms === 1){
				//set ms back to what it was originally set to
				ms = self.rotationDelay;
			}

			return this;
		},
		pause: function() {
			var self = this,
				o = this.options;

			self.rotate(0);
		},
		unpause: function(){
			var self = this,
				o = this.options;

			self.rotate(1, self.continuing);
		}
	});
})(jQuery);</pre></body></html>    ( > \ s � � � � �:                           �