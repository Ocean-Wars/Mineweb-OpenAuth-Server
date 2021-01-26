![OpenAuth Logo](http://image.noelshack.com/fichiers/2015/20/1431453946-banierreoauth.png)

# Notice

**THIS SOFTWARE IS PROVIDED "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.**

# Note

I am not the original author of this code, here is the original repository: [https://github.com/Litarvan/OpenAuth-Server](https://github.com/Litarvan/OpenAuth-Server)

# Aim of this repository

The aim of this repository is to make openauth compatible with [Mineweb](https://mineweb.org/)

When you try to log-in using a password, it search inside of the mineweb database for the user password hash instead of his own database.


This also add the session from mojang: https://wiki.vg/Protocol_Encryption#Authentication

# How to use it

modify the file config_base.php:

```php
return [
	
	// The auth informations
	'authinfos' => [
		// Name of the owner of this OpenAuth server
		'owner' => '',
	],

	// The database informations
	'database' => [
		'database' => '',
		'host' => '',
		'username' => '',
		'password' => ''
	],
	
	// If the register page is enabled
	'activeRegisterPage' => false,
];
```

For the database credentials, use the same as the one you used for your mineweb server.

You **must** change your mineweb password encryption to sha256 **without salt**.
