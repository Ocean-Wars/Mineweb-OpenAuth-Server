![OpenAuth Logo](http://image.noelshack.com/fichiers/2015/20/1431453946-banierreoauth.png)

# Notice

**THIS SOFTWARE IS PROVIDED "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.**

# Note

I am not the original author of this code, here is the original repository: [https://github.com/Litarvan/OpenAuth-Server](https://github.com/Litarvan/OpenAuth-Server)

# Aim of this repository

The aim of this repository is to make openauth compatible with [Mineweb](https://mineweb.org/)

When you try to log-in using a password, it search inside of the mineweb database for the user password hash instead of his own database.


This also add the sessions like if it was a mojang server: https://wiki.vg/Protocol_Encryption#Authentication

# How to use it

* Clone this repo inside /var/www/authserver (normally you already have a website for mineweb, you should clone this near it).
* Change your apache settings so there are two websites (mineweb + this auth server).
* Go to this website, it will ask you for you database credentials, put exactly the same as for mineweb.

Need help? Here is my discord: Lockface77#8305


You **must** change your mineweb password encryption to sha256 **without salt**.
