#include <stdio.h>
#include <stdlib.h>
int main()
{
    int A,B,divider;
    printf("Enter First Number : ");
    scanf("%d",&A);
    printf("Enter Second Number : ");
    scanf("%d",&B);
    if (A==0 || B==0)
    {
        printf("0");
        return 0;
    }
    if (A<0)
    {
        A*=-1;
    }
     if (B<0)
    {
        B*=-1;
    }
    
    if (A==B || B>A)
    {
        divider=A;
    }
    else if (A>B)
    {
        divider=B;
    }

    while (divider >= 0)
    {
        if (A%divider==0 && B%divider==0)
        {
            printf("Greatest common divisor is %d\n",divider);
            system("pause") ;
            return 0;
        }
        else divider -=1;
    }
    return 0;
}