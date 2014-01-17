#!/bin/bash

::igbinary::
pecl download igbinary
gzip -d < igbinary-1.1.1.tgz | tar -xvf -
cd igbinary-1.1.1
phpize
./configure --libdir=/usr/lib64/ --libexecdir=/usr/lib64/
make
make install


::memcached-2.2.0b1::
cd /usr/local/src; curl -O http://memcached.googlecode.com/files/memcached-2.2.0b1.tar.gz
tar zxvf memcached-1.4.5.tar.gz
cd memcached-1.4.5
./configure --libdir=/usr/lib64/ --libexecdir=/usr/lib64/
make
make install


::libmemcached-0.48::
cd /usr/local/src; wget http://launchpad.net/libmemcached/1.0/0.48/+download/libmemcached-0.48.tar.gz
tar zxvf libmemcached-0.48.tar.gz
cd libmemcached-0.48
./configure --libdir=/usr/lib64 --libexecdir=/usr/lib64
make
make install


::memcached-2.2.0b1::
phpize
./configure --libdir=/usr/lib64 --libexecdir=/usr/lib64 --enable-memcached=shared --enable-memcached-igbinary
make
make install
make test

;; simply ensure igbinary.so loads before memcached.so,