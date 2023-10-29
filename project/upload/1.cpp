#include<bits/stdc++.h>
using namespace std;

typedef long long int ll;

bool is_prime(int n)
{
    if(n == 1 || n == 0){
        return false;
    }
    for(int i=2; i*i<=n; i++){
        if(n % i == 0){
            return false;
        }
    }
    return true;
}

int count_prime(int arr[],int n)
{
    if(n == 0){
        return 0;
    }else{
        int c = count_prime(arr,n-1);
        if(is_prime(arr[n-1])){
            cout<<arr[n-1]<<" ";
            return c+1;
        }else{
            return c;
        }
        return c;
    }
}

int main()
{
    int n;
    cin>>n;
    int arr[n];
    for(int i=0; i<n; i++){
        cin>>arr[i];
    }
    int ans = count_prime(arr,n);
    cout<<endl;
    cout<<endl;
    cout<<"#primes="<<ans<<endl;
}

/*
    Explanation of is_prime function :
    let, n = 35;
    i = 2, 2*2=4<=35;
    i = 3, 3*3=9<=35;
    i = 4, 4*4=16<=35;
    i = 5, 5*5=25<=35;
    so we can see that, root(4)=2,root(9)=3,root(16)=4,root(25)=5;
    so up to root(n) will check if it is prime or not and it takes less time.
*/